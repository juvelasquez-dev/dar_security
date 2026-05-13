<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cart' => 'required|array|min:1',
        ]);

        $cart = $data['cart'];

        $totalQty = 0;
        $totalAmt = 0;

        foreach ($cart as $c) {
            $qty = isset($c['qty']) ? (int)$c['qty'] : 1;
            $price = isset($c['price']) ? (float)$c['price'] : 0;
            $totalQty += $qty;
            $totalAmt += $qty * $price;
        }

        $order = Order::create([
            'order_no' => 'ORD-' . strtoupper(Str::random(8)),
            'total_qty' => $totalQty,
            'total_amount' => $totalAmt,
            'items_count' => count($cart),
            'status' => 'pending',
            'payment_status' => 'pending',
            'meta' => null,
        ]);

        foreach ($cart as $c) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $c['id'] ?? null,
                'name' => $c['name'] ?? ($c['title'] ?? 'Item'),
                'price' => $c['price'] ?? 0,
                'qty' => $c['qty'] ?? 1,
                'subtotal' => ($c['price'] ?? 0) * ($c['qty'] ?? 1),
                'meta' => null,
            ]);
        }

        // Return JSON for AJAX flows; front-end will redirect.
        try {
            return response()->json([ 'success' => true, 'redirect' => route('arbos.orders') ]);
        } catch (\Exception $e) {
            return response()->json([ 'success' => false, 'message' => 'Could not determine redirect: ' . $e->getMessage() ], 500);
        }
    }
}
