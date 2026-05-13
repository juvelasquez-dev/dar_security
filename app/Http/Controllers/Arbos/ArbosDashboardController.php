<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller; // ✅ IMPORT THIS
use Illuminate\Http\Request;
use App\Models\Product;

class ArbosDashboardController extends Controller
{
    /**
     * Display the ARBOS dashboard.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $products = Product::orderBy('created_at', 'desc')->limit(8)->get();
        $topProducts = Product::orderByDesc('stock')->limit(5)->get();

        return view('arbos.dashboard.dashboard', [
            'totalProducts'        => $totalProducts,
            'products'             => $products,
            'topProducts'          => $topProducts,
            'totalOrders'          => 0,
            'totalRevenue'         => 0,
            'pendingOrders'        => 0,
            'pendingOrdersCount'   => 0,
            'processingOrdersCount'=> 0,
            'completedOrdersCount' => 0,
        ]);
    }

   
}