<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Filter by order code if provided
        $orderCode = $request->input('order_code');
        if ($orderCode) {
            $orders = Orders::with('orderDetails.product')
                ->where('order_code', 'like', '%' . $orderCode . '%')
                ->get();
        } else {
            $orders = Orders::with('orderDetails.product')->get();
        }

        $orders = Orders::with('orderDetails.product')->get();

        // return $orders;

        return view('pos.report', compact('orders'));
    }

    public function report(Request $request)
    {
        $date = $request->input('start_date');
        $endDate = $request->input('end_date');

        $start = Carbon::parse($date)->startOfDay(); // 00:00:00
        $end = Carbon::parse($endDate)->endOfDay();       // 23:59:59

        // $orders = Orders::whereBetween('created_at', [$start, $end])->get();
        $orders = Orders::with('orderDetails.product')->whereBetween('created_at', [$start, $end])->get();


        if ($request->ajax()) {
            return view('pos._orders_table', compact('orders'))->render();
        }

        return view('pos.report', compact('orders'));
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
            'order_code' => $request->receiptNo,
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
                if ($product->product_stock <= 0) {
                    $product->update(['is_active' => 0]);
                }
            }
        }

        // foreach ($cartItems as $item) {
        //     $product = Product::find($item['productId']);
        //     if ($product) {
        //         $product->decrement('product_stock', $item['qty']);
        //     }
        // }

        return redirect()->route('pos.dashboard')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Orders::with('orderDetails.product')->findOrFail($id);

        return view('pos.report', compact('order'));
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

    public function print($id)
    {
        // $order = Order::find($id);
        // $orderDetails = orderDetails::where('order_id', $id)->get();
        // $resonse = [
        //     'status' => 'success',
        //     'message' => 'Data found',
        //     'data' => $order,
        //     'orderDetails' => $orderDetails
        // ];
        // return response()->json($resonse, 200);
        $orders = Orders::with('orderDetails', 'category', 'product')->find($id);
        return view('pos.print', compact('id', 'orders'));
    }
}
