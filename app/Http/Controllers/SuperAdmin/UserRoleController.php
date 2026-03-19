<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Mail\NewUserCredentials;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserRoleController extends Controller
{
    /**
     * Display user roles management page.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('slug', $request->role);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->with(['role', 'province'])->latest()->paginate(10);

        // Load provinces for the add-user form
        $provinces = \App\Models\Province::orderBy('name')->get();

        $totalUsers = User::count();
        $totalSuperAdmins = User::whereHas('role', fn($q) => $q->where('slug', 'super_admin'))->count();
        $totalPBD = User::whereHas('role', fn($q) => $q->where('slug', 'pbd'))->count();
        $totalFinance = User::whereHas('role', fn($q) => $q->where('slug', 'finance'))->count();
        $totalArbo = User::whereHas('role', fn($q) => $q->where('slug', 'arbo'))->count();

        // CARPOS = users whose role is either 'pbd' or 'arbo' (single query to avoid mismatches)
        $totalCarposAdmins = User::whereHas('role', fn($q) => $q->whereIn('slug', ['pbd', 'arbo']))->count();
        $totalArboAdmins = $totalArbo;

        return view('super_admin.user_role.userRole', compact(
            'users',
            'totalUsers',
            'totalSuperAdmins',
            'totalPBD',
            'totalFinance',
            'totalArbo',
            'totalCarposAdmins',
            'totalArboAdmins',
            'provinces'
        ));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'nullable|email|max:150|unique:users,email',
            'contact_number' => 'nullable|string|max:20',
            'username' => 'required|string|max:100|unique:users,username',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:super_admin,pbd,finance,arbo',
            'status' => 'required|in:active,inactive',
            'province_id' => 'nullable|exists:provinces,id',
        ]);

        $role = $request->role;

        $roleModel = Role::where('slug', $role)->first();

        // If role is pbd, province_id is required
        if ($request->role === 'pbd') {
            $request->validate([
                'province_id' => 'required|exists:provinces,id',
            ]);
        }

        // Use provided password or generate a random one
        $plainPassword = $request->filled('password') ? $request->password : Str::random(12);
        $passwordHash = Hash::make($plainPassword);

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'username' => $request->username,
            'password' => $passwordHash,
            'role_id' => $roleModel?->id,
            'status' => $request->status,
            'province_id' => $request->province_id ?? null,
            'is_verified' => true,
        ]);
        // Attempt to send credentials to the user's email if provided
        $mailError = null;
        $mailSent = false;
        if (!empty($user->email)) {
            try {
                Mail::to($user->email)->send(new NewUserCredentials($user, $plainPassword));
                $mailSent = true;
            } catch (\Throwable $e) {
                report($e);
                $mailError = $e->getMessage();
            }
        }

        // Prepare flash message reflecting mail status
        $swal = [
            'icon' => 'success',
            'title' => 'User added',
            'text' => 'The user was created and verified successfully.'
        ];

        if (!empty($user->email)) {
            if ($mailSent) {
                $swal['text'] .= " Credentials were emailed to {$user->email}.";
            } else {
                $swal['icon'] = 'warning';
                $swal['text'] .= ' However, sending the credentials email failed.' . ($mailError ? " Error: {$mailError}" : '');
            }
        } else {
            // No email provided — show generated password to admin so it can be shared
            $swal['text'] .= " Generated password: {$plainPassword}";
        }

        return redirect()
            ->route('super_admin.user_roles.index')
            ->with('swal', $swal);
    }
}