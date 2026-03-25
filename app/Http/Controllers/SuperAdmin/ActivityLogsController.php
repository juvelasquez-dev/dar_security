<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\User;
use Carbon\Carbon;

class ActivityLogsController extends Controller
{
	/**
	 * Display activity logs page.
	 */
	public function index()
	{
		$request = request();

		$query = ActivityLog::query()->with(['user.role']);

		if ($request->filled('module')) {
			$query->where('module', $request->module);
		}

		if ($request->filled('date')) {
			$query->whereDate('created_at', $request->date);
		}

		if ($request->filled('search')) {
			$search = $request->search;
			$query->where(function ($q) use ($search) {
				$q->where('action', 'like', "%{$search}%")
				  ->orWhere('module', 'like', "%{$search}%")
				  ->orWhereJsonContains('meta->assigned_user_name', $search);
				// also match user name/email
				$q->orWhereHas('user', function ($u) use ($search) {
					$u->where('first_name', 'like', "%{$search}%")
					  ->orWhere('last_name', 'like', "%{$search}%")
					  ->orWhere('email', 'like', "%{$search}%");
				});
			});
		}

		$logs = $query->latest()->paginate(25);

		// Prepare description for each log if not set
		$logs->getCollection()->transform(function ($log) {
			if (empty($log->description)) {
				$meta = $log->meta ?? [];
				if (! empty($meta['assigned_user_name']) && ($log->action === 'assign_admin' || $log->action === 'assign')) {
					$log->description = 'Assigned ' . ($meta['assigned_user_name'] ?? 'user') . ' to ' . ($meta['to_province_name'] ?? ($meta['to_province_id'] ?? 'office'));
				} else {
					$log->description = $meta['message'] ?? ($log->action . ' — ' . json_encode($meta));
				}
			}
			return $log;
		});

		// Summary stats
		$today = Carbon::today();
		$totalLogsToday = ActivityLog::whereDate('created_at', $today)->count();
		$userActions = ActivityLog::whereDate('created_at', $today)->where('module', 'user')->count();
		$adminActions = ActivityLog::whereDate('created_at', $today)->where('module', 'admin')->count();
		$marketplaceActions = ActivityLog::whereDate('created_at', $today)->where('module', 'marketplace')->count();

		return view('super_admin.activitylogs.activitylogs', compact(
			'logs', 'totalLogsToday', 'userActions', 'adminActions', 'marketplaceActions'
		));
	}
}

