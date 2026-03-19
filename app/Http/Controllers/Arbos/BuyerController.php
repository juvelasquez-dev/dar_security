<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display the buyers page for ARBO.
     */
    public function index()
    {
        return view('arbos.buyer.buyer');
    }

    // Add other buyer-related actions here as needed.
}
