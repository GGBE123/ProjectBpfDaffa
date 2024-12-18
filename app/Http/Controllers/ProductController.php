<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Assuming you have a Product model
use App\Models\Category; // If products have categorie
use Illuminate\Support\Facades\Log;

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
        return view('products.add', compact('categories')); // Point to the Blade file
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255', // Validate the new category field
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle new category creation
        if ($request->filled('new_category')) {
            $category = Category::create([
                'name' => $request->input('new_category'),
            ]);
            // Assign the newly created category to the product
            $validatedData['category_id'] = $category->id;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        // Create the product
        Product::create($validatedData);

        return redirect()->route('products.manage')->with('success', 'Product added successfully!');
    }

    public function storePage(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search') && $request->input('search') != '') {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('description', 'like', '%' . $request->input('search') . '%');
        }

        // Filter by category (only if category is selected)
        if ($request->has('category_id') && $request->input('category_id') != '') {
            $query->where('category_id', $request->input('category_id'));
        }

        // Fetch categories for filter options
        $categories = Category::all();

        // Paginate products for easier navigation
        $products = $query->paginate(10);

        return view('store.index', compact('products', 'categories'));
    }

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
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update other fields
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category_id');
        $product->save();

        return redirect()->route('products.manage')->with('success', 'Product updated successfully!');
    }



    public function manageProducts()
    {
        $products = Product::with('category')->paginate(10); // Include categories for context
        $categories = Category::all(); // Fetch categories
        return view('products.manage', compact('products', 'categories'));
    }
}
