<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $kategori = [
            'Elektronik' => ['HP', 'Laptop', 'Aksesoris'],
            'Makanan' => ['Snack', 'Frozen'],
            'Fashion' => ['Pakaian Pria', 'Pakaian Wanita', 'Sepatu', 'Tas & Dompet', 'Aksesoris', 'Jam Tangan'],
            'Home & Living' => ['Furniture', 'Dekorasi', 'Perelatan Dapur', 'Perlengkapan Rumah'],
            'Sport & Outdoor' => ['Peralatan Olahraga', 'Outdoor & Camping', 'Fitness'],
            'Health & Beauty' => ['Skincare', 'Kesehatan', 'Suplemen'],
            'Books & Media' => ['Buku', 'Alat Tulis', 'Hobis & Koleksi'],
        ];

        foreach ($kategori as $parentName => $children) {
            $parent = KategoriProduk::create([
                'nama_kategori' => $parentName,
                'parent_id' => null,
                'slug' => Str::slug($parentName)
            ]);

            foreach($children as $childName){
                KategoriProduk::create([
                    'nama_kategori' => $childName,
                    'parent_id' => $parent->id,
                    'slug' => Str::slug($parent->slug . '-' . $childName)
                ]);
            }
        }
    }
}
