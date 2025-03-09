<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');


// Admin logout routex
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    });
Route::middleware('auth:admin')->get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.create'); // Create product
Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.store'); // Store product

// Show the form to edit a product
Route::get('/admin/products/{product}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
    
// Update a product
Route::put('/admin/products/{product}', [AdminController::class, 'update'])->name('admin.products.update');

// Delete a product
Route::delete('/admin/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/invoice', [InvoiceController::class, 'createInvoice'])->name('invoice.create');
Route::post('/cart/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/invoice', [InvoiceController::class, 'createInvoice'])->name('invoice.create');
Route::get('/cart/generateInvoice', [CartController::class, 'generateInvoice'])->name('cart.generateInvoice');

Route::post('/cart/save-invoice', [CartController::class, 'saveInvoice'])->name('cart.saveInvoice');