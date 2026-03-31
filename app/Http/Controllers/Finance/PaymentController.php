<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
	/**
	 * Display payments listing.
	 */
	public function index(Request $request)
	{
		return view('finance.payments.payments');
	}

	/**
	 * Show a specific payment (placeholder).
	 */
	public function show($id)
	{
		return view('finance.payments.payments', ['paymentId' => $id]);
	}
}

