<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    // Store the newly created product
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'category' => 'required|string',
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Picture validation
        ]);
        // Handle the picture upload
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('products', 'public'); // Store the image in the public/products directory
            }
        // Create the product
        $product = Product::create([
            'category' => $validated['category'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'picture' => $path ?? null, // Store the image path or null if no image uploaded
        ]);

        return redirect()->route('products.index'); // Redirect to the products list page
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
}