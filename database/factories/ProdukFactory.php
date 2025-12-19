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
            'category_id' => KategoriProduk::factory(),
            'nama_produk' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'harga_produk' => $this->faker->numberBetween(10000, 100000),
            'stok_produk' => $this->faker->numberBetween(1, 100),
            'deskripsi_produk' => $this->faker->paragraph(),
            'status_produk' => $this->faker->randomElement(['tersimpan', 'tersedia', 'habis']),
        ];
    }
}
