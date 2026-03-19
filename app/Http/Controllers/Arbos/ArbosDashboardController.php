<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller; // ✅ IMPORT THIS
use Illuminate\Http\Request;

class ArbosDashboardController extends Controller
{
    /**
     * Display the ARBOS dashboard.
     */
    public function index()
    {
        return view('arbos.dashboard.dashboard');
    }

   
}