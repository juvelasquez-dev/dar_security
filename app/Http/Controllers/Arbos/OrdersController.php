<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
	/**
	 * Display the orders page for ARBO.
	 */
	public function index()
	{
		return view('arbos.orders.orders');
	}
}

