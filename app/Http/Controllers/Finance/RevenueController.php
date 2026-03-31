<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display revenue overview.
     */
    public function index(Request $request)
    {
        return view('finance.revenue.revenue');
    }
}
