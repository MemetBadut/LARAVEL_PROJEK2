<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Alamat;
use App\Models\Produk;
use App\Models\OrderItem;
use App\Services\Tax\TaxService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutService
{
        public function __construct(
            protected TaxService $taxService
        ){}

    public function process(array $cart, Alamat $alamat){
        return DB::transaction(function () use ($cart, $alamat) {
            $produkIds = collect($cart)->pluck('produk_id')->toArray();

            $produks = Produk::whereIn('id', $produkIds)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $subtotal = 0;

            foreach ($cart as $item) {
                $produk = $produks->get($item['produk_id']);

                if (!$produk) {
                    throw new \Exception("Produk tidak tersedia");
                }

                if ($produk->stok_produk < $item['quantity']) {
                    throw new \Exception("Stok produk {$produk->nama_produk} tidak cukup");
                }

                $subtotal = collect($cart)->sum(
                    fn($item) => $item['harga_produk'] * $item['quantity']
                );
            }

            $taxResult = $this->taxService->calculate($subtotal);
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_harga' => $taxResult->total,
                'status' => 'pending',
                'alamat_pengiriman' => $alamat->alamat_lengkap,
                'provinsi' => $alamat->provinsi,
                'kota' => $alamat->kota,
                'kode_pos' => $alamat->kode_pos
            ]);

            foreach ($cart as $item){
                $produk = $produks->get($item['produk_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'produk_id' => $produk->id,
                    'jumlah_barang' => $item['quantity'],
                    'harga_satuan' => $item['harga_produk'],
                ]);

                $produk->decrement('stok_produk', $item['quantity']);
            }

            return $order;
        });
    }
}
