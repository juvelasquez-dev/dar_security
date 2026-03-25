<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = 128;
        $paidOrders = 96;
        $pendingPayments = 21;
        $cancelledOrders = 11;
        $totalRevenue = 245780.50;
        $monthlyRevenue = 68420.00;
        $activeArboTransactions = 14;

        $recentTransactions = collect([
            (object)[
                'order_no' => 'ORD-1001',
                'buyer' => 'Juan dela Cruz',
                'arbo' => 'Mabuhay Farmers Cooperative',
                'amount' => 12500.00,
                'payment_status' => 'paid',
                'order_status' => 'completed',
                'date' => now()->subHours(2),
            ],
            (object)[
                'order_no' => 'ORD-1002',
                'buyer' => 'Maria Santos',
                'arbo' => 'Bagong Pag-asa ARBO',
                'amount' => 8650.00,
                'payment_status' => 'pending',
                'order_status' => 'processing',
                'date' => now()->subHours(5),
            ],
            (object)[
                'order_no' => 'ORD-1003',
                'buyer' => 'Pedro Reyes',
                'arbo' => 'Catanduanes ARBO',
                'amount' => 15400.00,
                'payment_status' => 'paid',
                'order_status' => 'completed',
                'date' => now()->subDay(),
            ],
        ]);

        $revenueByArbo = collect([
            (object)['arbo' => 'Mabuhay Farmers Cooperative', 'orders' => 21, 'revenue' => 58200.00],
            (object)['arbo' => 'Bagong Pag-asa ARBO', 'orders' => 16, 'revenue' => 44350.00],
            (object)['arbo' => 'Catanduanes ARBO', 'orders' => 12, 'revenue' => 31840.00],
            (object)['arbo' => 'Masbate Agrarian Reform Coop', 'orders' => 10, 'revenue' => 27560.00],
        ]);

        return view('finance.dashboard.dashboard', compact(
            'totalOrders',
            'paidOrders',
            'pendingPayments',
            'cancelledOrders',
            'totalRevenue',
            'monthlyRevenue',
            'activeArboTransactions',
            'recentTransactions',
            'revenueByArbo'
        ));
    }
}