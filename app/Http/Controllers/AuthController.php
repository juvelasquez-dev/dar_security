<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    // Show Login Page
    public function showLoginForm()
    {
        return view('auth.login');
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

            // Redirect based on role slug
            switch ($role) {
                case 'super_admin':
                    return redirect()->route('super.admin.dashboard');
                case 'pbd':
                    return redirect()->route('admin.dashboard');
                case 'finance':
                    return redirect()->route('finance.dashboard');
                case 'arbo':
                case 'arbos':
                    return redirect()->route('arbos.dashboard');
                default:
                        Auth::logout();
                        return back()->withInput()->with('swal', [
                            'icon' => 'error',
                            'title' => 'Access denied',
                            'text' => 'Your account does not have a valid role.'
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
}