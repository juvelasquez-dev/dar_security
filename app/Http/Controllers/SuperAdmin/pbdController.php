<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PbdController extends Controller
{
    /**
     * Display PBD management page.
     */
    public function index()
    {
        // Load all provinces — each province represents a PBD office in the UI
        $provinces = Province::orderBy('name')->get();

        // For each province, find a CARPOS-PBD admin (user with role slug 'pbd') assigned to that province
        $offices = $provinces->map(function ($prov) {
            $admin = User::whereHas('role', fn($q) => $q->where('slug', 'pbd'))
                ->where('province_id', $prov->id)
                ->latest()
                ->first();

            // Ensure admin has a `name` attribute for legacy views that expect it
            if ($admin) {
                $admin->name = trim(($admin->first_name ?? '') . ' ' . ($admin->last_name ?? '')) ?: ($admin->username ?? $admin->email ?? '');
            }

            return (object) [
                'id' => $prov->id,
                'name' => 'CARPOS-PBD ' . $prov->name,
                'address' => null,
                'province' => $prov->name,
                'admin' => $admin,
                'contact_number' => $admin->contact_number ?? null,
                // infer office status from assigned admin status (active if admin exists and user.status === 'active')
                'status' => ($admin && ($admin->status === 'active')) ? 'active' : 'inactive',
                'created_at' => $prov->created_at ?? now(),
            ];
        });

        $totalOffices = $offices->count();
        $activeOffices = $offices->where('status', 'active')->count();
        $assignedAdmins = $offices->filter(fn($o) => ! empty($o->admin))->count();
        $inactiveOffices = $totalOffices - $activeOffices;

        // Available admins for assignment: all users whose role is 'pbd'
        $availableAdmins = User::whereHas('role', fn($q) => $q->where('slug', 'pbd'))->get();
        foreach ($availableAdmins as $a) {
            $a->name = trim(($a->first_name ?? '') . ' ' . ($a->last_name ?? '')) ?: ($a->username ?? $a->email ?? '');
        }

        // Paginate the offices collection so the view can call ->total() and ->links()
        $perPage = 10;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $items = $offices->slice(($page - 1) * $perPage, $perPage)->values();
        $officesPaginated = new LengthAwarePaginator($items, $offices->count(), $perPage, $page, [
            'path' => request()->url(), 'query' => request()->query()
        ]);

        return view('super_admin.pbdmanagement.pbdmanagement', [
            'offices' => $officesPaginated,
            'totalOffices' => $totalOffices,
            'activeOffices' => $activeOffices,
            'assignedAdmins' => $assignedAdmins,
            'inactiveOffices' => $inactiveOffices,
            'availableAdmins' => $availableAdmins,
        ]);
    }

    /**
     * Assign a CARPOS (PBD) admin to a province (office).
     */
    public function assignAdmin(Request $request, $provinceId)
    {
        $data = $request->validate([
            'admin_id' => 'required|exists:users,id',
            'remarks' => 'nullable|string|max:500',
        ]);

        $user = User::with('role')->find($data['admin_id']);
        if (! $user) {
            return redirect()->back()->with('error', 'Selected admin not found.');
        }

        // Ensure selected user is a PBD account (role slug 'pbd')
        if (! $user->role || $user->role->slug !== 'pbd') {
            return redirect()->back()->with('error', 'Selected user is not a PBD admin account.');
        }

        $previousProvinceId = $user->province_id;
        $previousProvinceName = $previousProvinceId ? optional(Province::find($previousProvinceId))->name : null;

        // If user already assigned to a different province, require explicit confirmation
        if ($previousProvinceId && $previousProvinceId != $provinceId && ! $request->boolean('confirm_reassign')) {
            $msg = 'Selected user is already assigned to ' . ($previousProvinceName ?? 'another province') . ". Please confirm reassignment.";
            return redirect()->back()->with('error', $msg);
        }

        // Assign the province to the user
        $user->province_id = $provinceId;
        $saved = $user->save();

        if ($saved) {
            // Log activity
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'assign_admin',
                'module' => 'pbd',
                'meta' => [
                    'assigned_user_id' => $user->id,
                    'assigned_user_name' => trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->username ?? $user->email ?? ''),
                    'from_province_id' => $previousProvinceId,
                    'from_province_name' => $previousProvinceName,
                    'to_province_id' => $provinceId,
                    'remarks' => $data['remarks'] ?? null,
                ],
            ]);

            return redirect()->back()->with('success', 'Assigned admin successfully.');
        }

        return redirect()->back()->with('error', 'Failed to assign admin.');
    }
}
