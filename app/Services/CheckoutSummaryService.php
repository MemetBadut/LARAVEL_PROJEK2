<?php

namespace App\Services;

use App\Models\Alamat;
use App\Models\Produk;
use App\DTO\CheckoutSummaryDTO;
use Illuminate\Support\Facades\Auth;

class CheckoutSummaryService
{
    const TAX_SERVICE = 0.11;

    public function summary(): CheckoutSummaryDTO
    {
        $user = Auth::user();
        $cartItems = session('cart', []);

        if (empty($cartItems)) {
            throw new \Exception('Keranjang kosong mpruy!');
        }

        $produkIds = collect($cartItems)->pluck('produk_id');

        $produks = Produk::whereIn('id', $produkIds)
            ->select('id', 'nama_produk', 'harga_produk', 'gambar')
            ->get()
            ->keyBy('id');

        $subtotal = collect($cartItems)->sum(
            fn($item) => ($item['harga_produk'] ?? 0) * ($item['quantity'] ?? 0)
        );

        $tax = $subtotal * self::TAX_SERVICE;

        $alamatUser = Alamat::where('user_id', $user->id)
        ->orderByDesc('is_default')
        ->first();

        return new CheckoutSummaryDTO(
            cartItems: $cartItems,
            produks: $produks,
            subtotal: $subtotal,
            tax: $tax,
            total: $subtotal + $tax,
            alamat: $alamatUser,
            phone: $user->phone
        );
    }
}
