<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Produk::all();

        foreach ($orders as $order) {
            $produk = $products->random();

            OrderItem::factory()->create([
                'order_id' => $order->id,
                'produk_id' => $produk->id,
                'jumlah_barang' => rand(1, 10),
                'harga_satuan' => $produk->harga_produk,
            ]);
        }
    }
}
