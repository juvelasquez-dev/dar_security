<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ActivityLog;
use App\Mail\NewUserCredentials;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        // Recent activity for side card
        $activities = ActivityLog::where('module', 'super_admin')
            ->whereIn('action', ['create_user', 'update_user', 'activate_user', 'deactivate_user'])
            ->latest()
            ->take(6)
            ->get();

        $recentActivities = $activities->map(function ($a) {
            $meta = is_array($a->meta) ? $a->meta : (array) $a->meta;
            $title = ucfirst(str_replace('_', ' ', $a->action));
            $metaText = '';
            $dot = 'ad-blue';
            $icon = 'bi-person-plus-fill';

            switch ($a->action) {
                case 'create_user':
                    $title = 'New user account created';
                    $role = $meta['role'] ?? '';
                    $metaText = 'A new ' . ($role ? $role . ' ' : '') . 'user was added';
                    $dot = 'ad-blue'; $icon = 'bi-person-plus-fill';
                    break;
                case 'update_user':
                    $title = 'Role updated';
                    $name = $meta['updated_user_name'] ?? $meta['created_user_name'] ?? 'User';
                    $newRole = $meta['role'] ?? '';
                    $metaText = $name . ($newRole ? ' changed to ' . $newRole : ' updated');
                    $dot = 'ad-gold'; $icon = 'bi-pencil-fill';
                    break;
                case 'activate_user':
                    $title = 'User reactivated';
                    $name = $meta['target_user_name'] ?? $meta['created_user_name'] ?? 'User';
                    $metaText = $name . ' account restored';
                    $dot = 'ad-green'; $icon = 'bi-check-circle-fill';
                    break;
                case 'deactivate_user':
                    $title = 'User deactivated';
                    $name = $meta['target_user_name'] ?? $meta['created_user_name'] ?? 'User';
                    $metaText = $name . ' account disabled';
                    $dot = 'ad-red'; $icon = 'bi-slash-circle-fill';
                    break;
                default:
                    $metaText = $meta['message'] ?? '';
            }

            return [
                'icon' => $icon,
                'dot' => $dot,
                'title' => $title,
                'meta' => $metaText,
                'time' => $a->created_at->diffForHumans(),
                'timestamp' => $a->created_at->toIso8601String(),
            ];
        })->toArray();

        return view('super_admin.user_role.userRole', compact(
            'users',
            'totalUsers',
            'totalSuperAdmins',
            'totalPBD',
            'totalFinance',
            'totalArbo',
            'totalCarposAdmins',
            'totalArboAdmins',
            'provinces',
            'recentActivities'
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
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
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

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'username' => $request->username,
            'password' => $passwordHash,
            'avatar' => $avatarPath,
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

        // Log activity
        try {
            $createdUserName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->username ?? '');
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'create_user',
                'module' => 'super_admin',
                'meta' => [
                    'created_user_id' => $user->id,
                    'created_user_name' => $createdUserName,
                    'role' => $roleModel?->name ?? $request->role,
                    'status' => $user->status,
                ],
            ]);
        } catch (\Throwable $e) { /* don't break user flow for logging errors */ }

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

    /**
     * Update an existing user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'nullable|email|max:150|unique:users,email,' . $user->id,
            'contact_number' => 'nullable|string|max:20',
            'username' => 'required|string|max:100|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:super_admin,pbd,finance,arbo',
            'status' => 'required|in:active,inactive',
            'province_id' => 'nullable|exists:provinces,id',
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->role === 'pbd') {
            $request->validate([
                'province_id' => 'required|exists:provinces,id',
            ]);
        }

        $roleModel = Role::where('slug', $request->role)->first();

        if ($request->hasFile('avatar')) {
            // delete old avatar if exists
            if (!empty($user->avatar)) {
                try { Storage::disk('public')->delete($user->avatar); } catch (\Throwable $e) { /* ignore */ }
            }
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->contact_number = $request->contact_number;
        $user->username = $request->username;
        $user->role_id = $roleModel?->id;
        $user->status = $request->status;
        $user->province_id = $request->province_id ?? null;

        $user->save();

        // Log update activity
        try {
            $updatedUserName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->username ?? '');
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'update_user',
                'module' => 'super_admin',
                'meta' => [
                    'updated_user_id' => $user->id,
                    'updated_user_name' => $updatedUserName,
                    'role' => $roleModel?->name ?? $request->role,
                    'status' => $user->status,
                ],
            ]);
        } catch (\Throwable $e) { /* ignore logging errors */ }

        $swal = [
            'icon' => 'success',
            'title' => 'User updated',
            'text' => 'The user profile was updated successfully.'
        ];

        return redirect()->route('super_admin.user_roles.index')->with('swal', $swal);
    }

    /**
     * Activate a user account.
     */
    public function activate(Request $request, User $user)
    {
        $user->status = 'active';
        $user->save();

        try {
            $name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->username ?? '');
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'activate_user',
                'module' => 'super_admin',
                'meta' => [
                    'target_user_id' => $user->id,
                    'target_user_name' => $name,
                ],
            ]);
        } catch (\Throwable $e) { /* ignore logging errors */ }

        $swal = [
            'icon' => 'success',
            'title' => 'User activated',
            'text' => 'The user account has been activated.'
        ];

        return redirect()->route('super_admin.user_roles.index')->with('swal', $swal);
    }

    /**
     * Deactivate a user account.
     */
    public function deactivate(Request $request, User $user)
    {
        $user->status = 'inactive';
        $user->save();

        try {
            $name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->username ?? '');
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'deactivate_user',
                'module' => 'super_admin',
                'meta' => [
                    'target_user_id' => $user->id,
                    'target_user_name' => $name,
                ],
            ]);
        } catch (\Throwable $e) { /* ignore logging errors */ }

        $swal = [
            'icon' => 'success',
            'title' => 'User deactivated',
            'text' => 'The user account has been deactivated.'
        ];

        return redirect()->route('super_admin.user_roles.index')->with('swal', $swal);
    }
}