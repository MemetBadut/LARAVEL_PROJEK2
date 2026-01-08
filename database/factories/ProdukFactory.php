<?php

namespace Database\Factories;

use App\Models\Vendor;
use App\Models\KategoriProduk;
use Illuminate\Support\Facades\Storage;
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
        if(!Storage::exists('public/produk')){
            Storage::makeDirectory('public/produk');
        }

        $gambarProduk = [
            'ipong.png',
            'laptop.png',
        ];

        $namaGambar = fake()->randomElement($gambarProduk);

        return [
            'vendor_id' => Vendor::factory(),
            'kategori_id' => KategoriProduk::factory(),
            'nama_produk' => fake()->word(),
            'slug' => fake()->unique()->slug(),
            'harga_produk' => fake()->numberBetween(10000, 100000),
            'stok_produk' => fake()->numberBetween(1, 100),
            'deskripsi_produk' => fake()->paragraph(),
            'gambar' => 'imageproduk/' . $namaGambar,
            'status_produk' => fake()->randomElement(['tersimpan', 'tersedia', 'habis']),
        ];
    }
}
