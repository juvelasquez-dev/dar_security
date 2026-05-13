<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
	/**
	 * Display the orders page for ARBO.
	 */
	public function index()
	{
		$orders = Order::with('items')->latest()->get();
		$totalOrders = $orders->count();
		return view('arbos.orders.orders', compact('orders','totalOrders'));
	}

	/**
	 * Return order details as JSON for modal view.
	 */
	public function show($id)
	{
		$order = Order::with('items')->findOrFail($id);
		return response()->json($order);
	}
}

