<?php

namespace App\Http\Controllers\Carpos;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	/**
	 * Display the CARPOS admin dashboard.
	 */
	public function index()
	{
		return view('carpos.dashboard.dashboard');
	}
}

