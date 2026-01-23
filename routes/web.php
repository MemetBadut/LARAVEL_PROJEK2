<?php

use App\Http\Controllers\AuthController;
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
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

// Rute untuk Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rute untuk Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Bagian Untuk yang tidak ada yang login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ProdukController::class, 'index'])->name('products.index');
Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('products.show');

// Route untuk User yang udah logi
Route::middleware('auth')->group(function () {
    // Untuk Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah/{produk}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/keranjang/{produk}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/keranjang/hapus/{produk}', [CartController::class, 'removeFromCart'])->name('cart.delete');

    // Untuk checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/pay', [CheckoutController::class, 'store'])->name('checkout.process');

    // Untuk Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'orderHistory']);
});

// Route untuk Vendor
Route::middleware(['auth', 'role:vendor'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {

        Route::get('/dashboard', [VendorDashboardController::class, 'vendorDash'])->name('vendorDashboard');

        Route::resource('/products', VendorProductController::class);
    });

// Route untuk Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('adminDashboard');

        Route::resource('/products', AdminProductController::class);
    });

// Untuk Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.show');
});
