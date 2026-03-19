<?php

namespace App\Http\Controllers\Carpos;

use App\Http\Controllers\Controller;

class MarketMonitoringController extends Controller
{
	/**
	 * Display the marketplace monitoring page.
	 */
	public function index()
	{
		return view('carpos.marketmonitoring.marketmonitoring');
	}
}

