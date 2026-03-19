<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class PbdController extends Controller
{
    /**
     * Display PBD management page.
     */
    public function index()
    {
        return view('super_admin.pbdmanagement.pbdmanagement');
    }
}
