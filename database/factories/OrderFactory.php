<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_harga' => fake()->numberBetween(50000, 2000000),
            'alamat_pengiriman' => fake('id_ID')->address(),
            'provinsi' => fake('id_ID')->state(),
            'kota' => fake('id_ID')->city(),
            'kode_pos' => fake('id_ID')->postcode(),
            'order_status' => fake()->randomElement(['pending', 'diproses', 'terbayar', 'dibatalkan', 'selesai']),
        ];
    }
}
