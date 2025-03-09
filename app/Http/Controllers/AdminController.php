<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;  // Import the Product model

class AdminController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('admin.login'); // View for the login form
    }

    // Handle the login logic
    public function login(Request $request)
    {
        // Validate the login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to login using the admin guard
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            // Redirect to the admin dashboard if authentication is successful
            return redirect()->route('admin.dashboard');
        }

        // Redirect back with an error message if authentication fails
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        // Get the products to display in the dashboard
        $products = Product::all();  // This fetches all products from the database

        // Pass the products variable to the view
        return view('admin.dashboard', compact('products'));
    }
    

    // Handle the logout
    public function logout()
    {
        Auth::guard('admin')->logout(); // Log the admin out
        return redirect()->route('admin.login'); // Redirect to login page
    }
    // Show the form to create a new product
    public function create()
    {
        return view('admin.create');
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:80',
            'price' => 'required|numeric',
            'stock' =>'required|numeric',
            'category' => 'required|string'
        ]);

        Product::create($request->all());

        return redirect()->route('admin.dashboard');
    }
    // Show the form to edit a product
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Fetch the product by ID
        return view('admin.edit', compact('product')); // Pass the product to the edit view
    }
    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id); // Fetch the product by ID

        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    // Update product data
    $product->update($validated);

    // If a new picture is uploaded, store the picture
    if ($request->hasFile('picture')) {
        $path = $request->file('picture')->store('public/products');
        $product->update(['picture' => $path]);
    }
    return redirect()->route('admin.dashboard'); // Redirect to the products index page after update
    }

    // Destroy (delete) a product
    public function destroy($id)
    {
    $product = Product::findOrFail($id); // Fetch the product by ID
    $product->delete(); // Delete the product from the database

    return redirect()->route('admin.dashboard'); // Redirect back to the products list page
    }

}
