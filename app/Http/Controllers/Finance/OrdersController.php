<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OrdersController extends Controller
{
	/**
	 * Display a listing of orders.
	 */
	public function index(Request $request)
	{
		// Provide a safe default empty paginator and related summary vars
		$orders = new LengthAwarePaginator([], 0, 15, $request->get('page', 1), [
			'path' => $request->url(),
			'query' => $request->query(),
		]);

		$viewData = [
			'orders' => $orders,
			'totalOrders' => 0,
			'processingOrders' => 0,
			'completedOrders' => 0,
			'pendingOrders' => 0,
			'cancelledOrders' => 0,
			'arboS' => [],
			'arbos' => [],
		];

		return view('finance.orders.orders', $viewData);
	}

	/**
	 * Display a single order.
	 */
	public function show($id)
	{
		// Reuse index defaults and include the requested orderId for the frontend
		$orders = new LengthAwarePaginator([], 0, 15, 1, ['path' => url('/finance/orders')]);
		$viewData = [
			'orders' => $orders,
			'totalOrders' => 0,
			'processingOrders' => 0,
			'completedOrders' => 0,
			'pendingOrders' => 0,
			'cancelledOrders' => 0,
			'arboS' => [],
			'arbos' => [],
			'orderId' => $id,
		];

		return view('finance.orders.orders', $viewData);
	}
}

