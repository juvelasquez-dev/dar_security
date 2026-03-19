<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class SalesReportController extends Controller
{
    /**
     * Display the sales report page for Super Admin.
     */
    public function index()
    {
        return view('super_admin.salesreport.salesreport');
    }
}
