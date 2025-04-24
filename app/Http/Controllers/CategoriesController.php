<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all categories from the database
        $categories = Categories::all();

        // Return the view with the categories data
        return view('pos.category', compact('categories'));
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
        $data = [
            'name_category' => $request->name,
        ];

        Categories::create($data);
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
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
        $category = Categories::findOrFail($id);
        $category->update([
            'name_category' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
