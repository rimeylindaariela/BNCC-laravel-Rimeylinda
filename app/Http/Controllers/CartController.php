<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Product;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CartController extends Controller
{
    // Add product to cart
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = Cart::where('product_id', $product->id)->where('user_id', auth()->id())->first();

        if ($cart) {
            $cart->quantity++;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->route('cart.view');
    }

    // View cart
    public function viewCart()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return view('cart.view', compact('cartItems'));
    }

    
    // Generate an invoice for the user
    public function generateInvoice()
    {
        // Get all cart items for the authenticated user
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        // Calculate the subtotal and total
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Generate an invoice number
        $invoiceNumber = 'INV-' . strtoupper(Str::random(8));
        
        

        // Create a new invoice
        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'invoice_number' => $invoiceNumber,
            'total' => $subtotal,
            'address' => " ",  // Add the address
            'postcode' => " ",  // Add the postcode
            
        ]);

        // Return the view for the invoice generation
        return view('cart.invoice', compact('cartItems', 'subtotal', 'invoiceNumber'));
    }
    public function saveInvoice(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:10',
        ]);

    // Save invoice details (address, postcode) to the database or perform other actions
        $invoice = Invoice::where('user_id', auth()->id())->latest()->first();
        $invoice->address = $request->address;
        $invoice->postcode = $request->postcode;
        $invoice->save();
        
    // Example: Save invoice address and postcode (you can extend this logic)
        
        return redirect()->route('cart.view')->with('success', 'Invoice saved successfully!'); // Redirect to cart or invoice page
    }
}

