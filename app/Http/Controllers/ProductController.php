<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all products from the database
        $products = Product::with('category')->get();
        $categories = Categories::orderBy('id', 'desc')->get();

        // Return the view with the products data
        return view('pos.product', compact('products', 'categories'));
    }

    public function getProduct()
    {
        $products = Product::where('is_active', 1)->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => (int)$product->product_price,
                'image' => $product->product_photo,
                'option' => '',
            ];
        });
        return view('pos.index', compact('products'));
    }

    public function addStock(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->product_stock += $request->stock;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Stock updated successfully.');
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
        $product_code = Product::max('id');
        $product_code++;
        $product_code = 'PR-' . date('dmY') . sprintf('%04d', $product_code);

        $data = [
            'category_id' => $request->category,
            'product_name' => $request->name,
            'product_code' => $product_code,
            'product_price' => $request->price,
            'product_description' => $request->description,
            'product_stock' => $request->stock,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo')->store('products', 'public');
            $data['product_photo'] = $file;
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
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
        $product = Product::findOrFail($id);
        $data = [
            'category_id' => $request->category,
            'product_name' => $request->name,
            'product_code' => $product->product_code,
            'product_price' => $request->price,
            'product_description' => $request->description,
            'product_stock' => $request->stock,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('photo')) {
            if ($product->product_photo) {
                File::delete(public_path('storage/' . $product->product_photo));
            }

            $file = $request->file('photo')->store('products', 'public');
            $data['product_photo'] = $file;
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->product_photo) {
            File::delete(public_path('storage/' . $product->product_photo));
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
