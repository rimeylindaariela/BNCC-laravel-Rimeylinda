<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function generateInvoice()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $invoiceNumber = 'INV-' . strtoupper(str_random(8));

        return view('invoice.generate', compact('cartItems', 'total', 'invoiceNumber'));
    }

    
}
