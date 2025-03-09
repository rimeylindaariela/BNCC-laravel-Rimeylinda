<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

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