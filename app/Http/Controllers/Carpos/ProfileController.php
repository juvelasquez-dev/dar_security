<?php

namespace App\Http\Controllers\Carpos;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
	/**
	 * Display the CARPOS admin profile page.
	 */
	public function index()
	{
		return view('carpos.profile.profile');
	}
}

