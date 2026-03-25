<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    // Show Login Page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Send password reset link to given email (AJAX)
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => __($status),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __($status),
        ], 422);
    }

    // Show password reset form (from emailed link)
    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->query('email', '');
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    // Handle password reset submission
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = FacadesHash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('swal', [
                'icon' => 'success',
                'title' => 'Password reset',
                'text' => 'Your password has been reset. You can now sign in.'
            ]);
        }

        return back()->withInput()->with('swal', [
            'icon' => 'error',
            'title' => 'Reset failed',
            'text' => __($status)
        ]);
    }

    // Show Register Page
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Assign ARBO role by default for self-registered users
        $arboRole = Role::where('slug', 'arbo')->first();
        if (!$arboRole) {
            return back()->withInput()->with('swal', [
                'icon' => 'error',
                'title' => 'Registration failed',
                'text' => 'ARBO role is not available. Please contact admin.'
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $arboRole->id,
        ]);

        // Do NOT auto-login newly registered users. They must be verified by Super Admin first.
        return redirect()->route('login')->with('swal', [
            'icon' => 'success',
            'title' => 'Registration submitted',
            'text' => 'Your registration has been submitted and is pending Super Admin verification. You will be able to log in once approved.'
        ]);
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;
        // Attempt login using Laravel Auth
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();

            $user = Auth::user();
            $fullName = trim(($user->first_name ?? '') . ' ' . ($user->middle_name ?? '') . ' ' . ($user->last_name ?? ''));
            $welcome = $fullName ? "Welcome back, $fullName." : 'Welcome back.';

            // Prevent unverified users from logging in
            if (isset($user->is_verified) && !$user->is_verified) {
                Auth::logout();
                return back()->withInput()->with('swal', [
                    'icon' => 'warning',
                    'title' => 'Account pending',
                    'text' => 'Your account is pending verification by the Super Admin. You cannot login yet.'
                ]);
            }

            $role = $user->role?->slug;

            // Two-step: send verification code via email before finalizing login
            try {
                $code = rand(100000, 999999);
                // store code in cache for 10 minutes
                Cache::put('login_code_' . $user->id, $code, now()->addMinutes(10));
                // store pending user id in session
                session(['login_mfa_user_id' => $user->id]);
                // logout the user until code is verified
                Auth::logout();
                // send email
                Mail::to($user->email)->send(new \App\Mail\LoginVerificationCode($user, $code));

                return redirect()->route('login.verify')->with('swal', [
                    'icon' => 'info',
                    'title' => 'Verification code sent',
                    'text' => 'A verification code was sent to your email. Please enter it to continue.'
                ]);
            } catch (\Exception $e) {
                Log::error('Failed sending login verification code: ' . $e->getMessage());
                Auth::logout();
                return back()->withInput()->with('swal', [
                    'icon' => 'error',
                    'title' => 'Email failed',
                    'text' => 'Failed to send verification code. Please try again later.'
                ]);
            }
        }

        return back()->withInput()->with('swal', [
            'icon' => 'error',
            'title' => 'Invalid credentials',
            'text' => 'Please check your email and password.'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function superAdminDashboard()
    {
        if (!session('superadmin')) {
            return redirect()->route('login');
        }

        return view('super_admin.dashboard.dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        $user = Auth::user();
        $fullName = trim(($user->first_name ?? '') . ' ' . ($user->middle_name ?? '') . ' ' . ($user->last_name ?? ''));

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('swal', [
            'icon' => 'success',
            'title' => 'Logged out',
            'text' => 'You have been logged out.'
        ]);
    }

    // Show verify code form
    public function showVerifyForm()
    {
        if (! session('login_mfa_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.verify-code');
    }

    // Handle verification code submission
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6'
        ]);

        $userId = session('login_mfa_user_id');
        if (! $userId) {
            return redirect()->route('login')->with('swal', [
                'icon' => 'error',
                'title' => 'Session expired',
                'text' => 'Please login again.'
            ]);
        }

        $cached = Cache::get('login_code_' . $userId);
        if (! $cached || $cached != $request->code) {
            return back()->withInput()->with('swal', [
                'icon' => 'error',
                'title' => 'Invalid code',
                'text' => 'The verification code is incorrect or expired.'
            ]);
        }

        // Code valid — log the user in
        $user = User::find($userId);
        if (! $user) {
            return redirect()->route('login')->with('swal', [
                'icon' => 'error',
                'title' => 'User not found',
                'text' => 'Please login again.'
            ]);
        }

        Auth::loginUsingId($user->id);
        // cleanup
        Cache::forget('login_code_' . $userId);
        session()->forget('login_mfa_user_id');
        request()->session()->regenerate();

        $fullName = trim(($user->first_name ?? '') . ' ' . ($user->middle_name ?? '') . ' ' . ($user->last_name ?? ''));
        $welcome = $fullName ? "Welcome back, $fullName." : 'Welcome back.';

        $role = $user->role?->slug;
        switch ($role) {
            case 'super_admin':
                return redirect()->route('super.admin.dashboard')->with('swal', [
                    'icon' => 'success',
                    'title' => 'Welcome',
                    'text' => $welcome,
                ]);
            case 'pbd':
                return redirect()->route('admin.dashboard')->with('swal', [
                    'icon' => 'success',
                    'title' => 'Welcome',
                    'text' => $welcome,
                ]);
            case 'finance':
                return redirect()->route('finance.dashboard')->with('swal', [
                    'icon' => 'success',
                    'title' => 'Welcome',
                    'text' => $welcome,
                ]);
            case 'arbo':
            case 'arbos':
                return redirect()->route('arbos.dashboard')->with('swal', [
                    'icon' => 'success',
                    'title' => 'Welcome',
                    'text' => $welcome,
                ]);
            default:
                Auth::logout();
                return redirect()->route('login')->with('swal', [
                    'icon' => 'error',
                    'title' => 'Access denied',
                    'text' => 'Your account does not have a valid role.'
                ]);
        }
    }
}