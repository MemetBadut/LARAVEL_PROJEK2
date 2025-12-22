<?php

namespace Database\Factories;

use App\Models\KategoriProduk;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vendor_id' => Vendor::factory(),
            'kategori_id' => KategoriProduk::factory(),
            'nama_produk' => fake()->word(),
            'slug' => fake()->unique()->slug(),
            'harga_produk' => fake()->numberBetween(10000, 100000),
            'stok_produk' => fake()->numberBetween(1, 100),
            'deskripsi_produk' => fake()->paragraph(),
            'status_produk' => fake()->randomElement(['tersimpan', 'tersedia', 'habis']),
        ];
    }
}
