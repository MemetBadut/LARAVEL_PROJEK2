<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Bagian Untuk yang tidak ada yang login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);

// Route untuk User yang udah logi
Route::middleware('auth')->group(function(){
    // Untuk Keranjang
    Route::get('/keranjang', [CartController::class, 'index']);
    Route::post('/keranjang/tambah/{produkId}', [CartController::class, 'addToCart']);
    Route::post('/keranjang/update/{produkId}', [CartController::class, 'updateCart']);
    Route::delete('/keranjang/hapus/{itemId}', [CartController::class, 'removeFromCart']);

    // Untuk checkout
    Route::get('/checkout', [CartController::class, 'checkoutForm']);
    Route::post('/checkout', [CartController::class, 'processCheckout']);

    // Untuk Order
    Route::get('/orders', [OrderController::class, 'orderHistory']);
    Route::post('/orders/', [OrderController::class, 'orderHistory']);
});



