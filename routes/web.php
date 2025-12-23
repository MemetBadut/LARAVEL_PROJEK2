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
use App\Http\Controllers\ProfileController;

// Bagian Untuk yang tidak ada yang login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ProdukController::class, 'index'])->name('products.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('products.show');

// Route untuk User yang udah logi
Route::middleware('auth')->group(function () {
    // Untuk Keranjang
    Route::get('/keranjang', [CartController::class, 'index']);
    Route::post('/keranjang/tambah/{produk}', [CartController::class, 'addToCart']);
    Route::post('/keranjang/update/{produk}', [CartController::class, 'updateCart']);
    Route::delete('/keranjang/hapus/{produk}', [CartController::class, 'removeFromCart']);

    // Untuk checkout
    Route::get('/checkout', [CartController::class, 'checkoutForm']);
    Route::post('/checkout', [CartController::class, 'processCheckout']);

    // Untuk Order
    Route::get('/orders', [OrderController::class, 'orderHistory']);
    Route::post('/orders/{order}', [OrderController::class, 'orderHistory']);
});

// Route untuk Vendor
Route::middleware(['auth', 'role:vendor'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {

        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/products', VendorProductController::class);
    });
// Route untuk Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/products', AdminProductController::class);
    });
// Untuk Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
// Untuk keranjang
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{produk}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/update/{produk}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{produk}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});


