<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
	/**
	 * Display a listing of orders.
	 */
	public function index(Request $request)
	{
		return view('finance.orders.orders');
	}

	/**
	 * Display a single order.
	 */
	public function show($id)
	{
		return view('finance.orders.orders', ['orderId' => $id]);
	}
}

