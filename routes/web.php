<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\DashboardController as VendorDashboardController;
use App\Http\Controllers\Vendor\ProdukController as VendorProductController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProdukController as AdminProductController;

// Bagian Untuk yang tidak ada yang login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);

// Route untuk User yang udah logi
Route::middleware('auth')->group(function () {
    // Untuk Keranjang
    Route::get('/keranjang', [CartController::class, 'index']);
    Route::post('/keranjang/tambah/{produk_id}', [CartController::class, 'addToCart']);
    Route::post('/keranjang/update/{produk_id}', [CartController::class, 'updateCart']);
    Route::delete('/keranjang/hapus/{produk_id}', [CartController::class, 'removeFromCart']);

    // Untuk checkout
    Route::get('/checkout', [CartController::class, 'checkoutForm']);
    Route::post('/checkout', [CartController::class, 'processCheckout']);

    // Untuk Order
    Route::get('/orders', [OrderController::class, 'orderHistory']);
    Route::post('/orders/{order_id}', [OrderController::class, 'orderHistory']);
});

Route::middleware(['auth', 'role:vendor'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {

        Route::get('/dashboard', [VendorDashboardController::class, 'index']);

        Route::resource('/products', VendorProductController::class);
    });

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        Route::resource('/products', AdminProductController::class);
    });
