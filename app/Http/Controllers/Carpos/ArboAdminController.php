<?php

namespace App\Http\Controllers\Carpos;

use App\Http\Controllers\Controller;

class ArboAdminController extends Controller
{
	/**
	 * Show ARBO Admins management page.
	 */
	public function index()
	{
		return view('carpos.arboadmin.arboadmin');
	}
}

