<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class ActivityLogsController extends Controller
{
	/**
	 * Display activity logs page.
	 */
	public function index()
	{
		return view('super_admin.activitylogs.activitylogs');
	}
}

