<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Display the sellers page for ARBO.
     */
    public function index()
    {
        return view('arbos.seller.seller');
    }

    // Add other seller-related actions here as needed.
}
