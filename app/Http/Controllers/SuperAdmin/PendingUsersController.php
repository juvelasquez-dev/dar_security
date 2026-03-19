<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PendingUsersController extends Controller
{
    public function index()
    {
        // allow access for super admin only (by role or session flag)
        $user = Auth::user();
        if (! $user || ($user->role?->slug ?? session('superadmin')) !== 'super_admin') {
            abort(403);
        }

        $pending = User::where('is_verified', false)->orderBy('created_at', 'desc')->get();

        return view('super_admin.pending_users.index', compact('pending'));
    }

    public function verify(Request $request, User $user)
    {
        $current = Auth::user();
        if (! $current || ($current->role?->slug ?? session('superadmin')) !== 'super_admin') {
            abort(403);
        }

        $user->is_verified = true;
        $user->save();

        return back()->with('swal', [
            'icon' => 'success',
            'title' => 'User verified',
            'text' => "{$user->name} has been verified and can now log in."
        ]);
    }
}
