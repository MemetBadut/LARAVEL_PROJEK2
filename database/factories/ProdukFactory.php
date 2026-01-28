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

    private const STOK_HABIS = 0;
    private const STOK_HAMPIR_HABIS = 10;

    public function definition(): array
    {
        if (!Storage::exists('public/produk')) {
            Storage::makeDirectory('public/produk');
        }

        $gambarProduk = [
            'ipong.png',
            'laptop.png',
        ];

        $namaGambar = fake()->randomElement($gambarProduk);

        $stok = $this->stokRealistis();
        $status = $this->statusStok($stok);


        return [
            'vendor_id' => Vendor::factory(),
            'kategori_id' => KategoriProduk::factory(),
            'nama_produk' => fake()->word(),
            'slug' => fake()->unique()->slug(),
            'harga_produk' => fake()->numberBetween(10000, 100000),
            'stok_produk' => $stok,
            'deskripsi_produk' => fake()->paragraph(),
            'gambar' => 'imageproduk/' . $namaGambar,
            'status_produk' => $status,
        ];
    }

    private function stokRealistis()
    {
        $random = rand(1, 100);

        if ($random <= 10) {
            return 0;
        } elseif ($random <= 30) {
            return rand(1, self::STOK_HAMPIR_HABIS);
        } else {
            return rand(self::STOK_HAMPIR_HABIS + 1, 100);
        }
    }

    private function statusStok(int $stok)
    {
        return match (true) {
            $stok === self::STOK_HABIS => 'habis',
            $stok === self::STOK_HAMPIR_HABIS => 'hampir_habis',
            default => 'tersedia'
        };
    }

    public function habis()
    {
        return $this->state(function (array $attributes) {
            return [
                'stok_produk' => 0,
                'status_produk' => 'habis',
            ];
        });
    }

    public function hampirHabis()
    {
        return $this->state(function (array $attributes) {
            $stok = rand(1, self::STOK_HAMPIR_HABIS);
            return [
                'stok_produk' => $stok,
                'status_produk' => 'hampir_habis',
            ];
        });
    }

    public function tersedia()
    {
        return $this->state(function (array $attributes) {
            $stok = rand(self::STOK_HAMPIR_HABIS + 1, 100);
            return [
                'stok_produk' => $stok,
                'status_produk' => 'tersedia',
            ];
        });
    }
}
