<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'produk_id' => Produk::factory(),
            'jumlah_barang' => fake()->numberBetween(1, 10),
            'harga_satuan' => fake()->randomFloat(2, 10000, 100000),
        ];
    }
}
