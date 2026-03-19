<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display the products page for ARBO.
     */
    public function index()
    {
        return view('arbos.products.products');
    }
}
