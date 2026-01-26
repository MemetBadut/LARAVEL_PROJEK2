<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingMethod::insert([
            [
                'nama' => 'JNE Regular',
                'deskripsi' => 'Estimasi 2-3 hari',
                'harga_ongkir' => 15000,
                'is_active' => true
            ],
            [
                'nama' => 'J&T Express',
                'deskripsi' => 'Estimasi 1-2 hari',
                'harga_ongkir' => 18000,
                'is_active' => true
            ],
            [
                'nama' => 'J&T Express',
                'deskripsi' => 'Estimasi 1-2 hari',
                'harga_ongkir' => 18000,
                'is_active' => true
            ]
        ]);
    }
}
