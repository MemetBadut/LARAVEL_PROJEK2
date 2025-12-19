<?php

use App\Http\Controllers\ProdukController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/products', ProdukController::class);


// Route::middleware(['auth', 'role:' . User::ROLE_ADMIN . ',' . User::ROLE_VENDOR])->group(function () {
//     Route::resource('/products', ProdukController::class);
// });
