<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Assuming you have a Product model
use App\Models\Category; // If products have categorie

class ProductController extends Controller
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
        $categories = Category::all(); // Load categories if needed
        return view('admin.products.add', compact('categories')); // Point to the Blade file
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id', // If using categories
        ]);

        Product::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Product added successfully!');
    }

    public function storePage(Request $request)
{
    $query = Product::query();

    // Search functionality
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->input('search') . '%')
              ->orWhere('description', 'like', '%' . $request->input('search') . '%');
    }

    // Filter by category
    if ($request->has('category_id')) {
        $query->where('category_id', $request->input('category_id'));
    }

    $categories = Category::all(); // Fetch categories for filter options
    $products = $query->paginate(10); // Paginate products for easier navigation

    return view('store.index', compact('products', 'categories'));
}


    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
{
    $categories = Category::all();
    return view('admin.products.edit', compact('product', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'nullable|exists:categories,id',
    ]);

    $product->update($validatedData);

    return redirect()->route('admin.products.manage')->with('success', 'Product updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();
    return redirect()->route('admin.products.manage')->with('success', 'Product deleted successfully!');
    }

    public function manageProducts()
{
    $products = Product::with('category')->paginate(10); // Include categories for context
    return view('admin.products.manage', compact('products'));
}

}
