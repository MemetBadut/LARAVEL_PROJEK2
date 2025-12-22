<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = User::where('role', User::ROLE_CUSTOMER)->get();

        foreach ($customers as $customer) {
            Order::factory()->create([
                'customer_id' => $customer->id,
            ]);
        }
    }
}
