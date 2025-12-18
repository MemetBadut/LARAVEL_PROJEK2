<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:' . User::ROLE_ADMIN . ',' . User::ROLE_VENDOR])->group(function () {
    // Route::resoure('/products', ProductController::class);
});
