<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('products.index')
            : redirect()->route('shop.index');
    }
    return redirect()->route('login');
});

// Shop
Route::get('/home', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop', [ShopController::class, 'view'])->name('shop');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
    Route::patch('products/{product}/stock', [ProductController::class, 'updateStock'])->name('products.updateStock');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
});

// Customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.detail');
    Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
    Route::post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [ShopController::class, 'updateCart'])->name('cart.update');
    Route::post('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::get('/orders', [ShopController::class, 'transactionHistory'])->name('orders.history');

    // ✅ Rute inilah yang digunakan oleh form ulasan
    Route::post('/product/{id}/comment', [CommentController::class, 'store'])->name('product.comment');
    Route::get('/product/{id}', [ShopController::class, 'show'])->name('product.detail');

    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});