<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display the products page for ARBO.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->take(12)->get();
        $totalProducts = Product::count();
        $pendingProducts = Product::where('status', 'pending')->count();
        $outOfStockProducts = Product::where('stock', '<=', 0)->count();

        return view('arbos.products.products', compact('products', 'totalProducts', 'pendingProducts', 'outOfStockProducts'));
    }
}
