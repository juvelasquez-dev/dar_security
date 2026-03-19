<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    /**
     * Display the sales reports page for ARBO.
     */
    public function index()
    {
        return view('arbos.reports.reports');
    }
}
