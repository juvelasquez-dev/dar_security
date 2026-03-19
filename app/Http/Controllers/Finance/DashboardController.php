<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	/**
	 * Display the Finance dashboard.
	 */
	public function index()
	{
		return view('finance.dashboard.dashboard');
	}
}

