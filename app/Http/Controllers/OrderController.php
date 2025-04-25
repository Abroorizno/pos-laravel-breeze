<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //ORDER CODE
        $order_code = Orders::max('id') + 1;
        $order_code++;
        $order_code = 'TRX-' . date('dmY') . sprintf('%04d', $order_code);

        $cartItems = json_decode($request->cart, true);

        $orders = Orders::create([
            'order_code' => $order_code,
            'order_mount' => $request->total,
            'order_change' => $request->change,
            'payment_amount' => $request->cash,
            'order_status' => 1,
        ]);

        foreach ($cartItems as $item) {
            $order = [
                'order_id' => $orders->id,
                'product_id' => $item['productId'],
                'qty' => $item['qty'],
                'order_price' => $item['price'],
                'order_subtotal' => $item['qty'] * $item['price'],
            ];
            OrderDetails::create($order);
        }

        // Update product stock
        foreach ($cartItems as $item) {
            $product = Product::find($item['productId']);
            if ($product) {
                $product->decrement('product_stock', $item['qty']);
            }
        }
        
        return redirect()->route('pos.dashboard')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
