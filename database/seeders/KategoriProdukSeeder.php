<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parent = KategoriProduk::factory()->create([
            'nama_kategori' => 'Elektronik',
            'parent_id' => null,
            'slug' => 'elektronik',
        ]);

        KategoriProduk::factory()->create([
            'nama_kategori' => 'Handphone',
            'parent_id' => $parent->id,
            'slug' => 'handphone',
        ]);

        KategoriProduk::factory()->create([
            'nama_kategori' => 'Laptop',
            'parent_id' => $parent->id,
            'slug' => 'laptop',
        ]);
    }
}
