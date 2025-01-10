<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import the Product model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    // Store a new product
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'product_code' => 'required',
            'name' => 'required|min:3|max:255|regex:/^\S.*\S$/',
            'category' => 'required|in:Kategori 1,Kategori 2,Kategori 3',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Store the image file and get the file path
        $imagePath = $request->file('image')->store('products', 'public');

        // Create a new product in the database
        Product::create([
            'image' => $imagePath,
            'product_code' => $request->product_code,
            'name' => $request->name,
            'category' => $request->category,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        // Redirect to the homepage
        return redirect('/home');
    }

    // Show the edit form for a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit', compact('product'));
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'product_code' => 'required',
            'name' => 'required|min:3|max:255|regex:/^\S.*\S$/',
            'category' => 'required|in:Kategori 1,Kategori 2,Kategori 3',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Store the new image and get the file path
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // Update the product's data
        $product->update($request->only([
            'product_code', 'name', 'category', 'stock', 'price'
        ]));

        // Redirect to the homepage
        return redirect('/home');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Redirect to the homepage
        return redirect('/home');
    }
}
