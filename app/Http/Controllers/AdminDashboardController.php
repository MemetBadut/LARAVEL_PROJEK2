<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function adminDashboard(){
        $lastestProduk = Produk::select('nama_produk', 'harga_produk', 'stok_produk', 'created_at')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard');
    }
}
