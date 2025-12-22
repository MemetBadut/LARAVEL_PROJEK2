<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = KategoriProduk::all();

        Vendor::chunk(10, function($vendor) use ($categories) {
            Produk::factory(50)->create([
                'vendor_id' => $vendor->id,
                'kategori_id' => $categories->random()->id,
            ]);
        });
    }
}
