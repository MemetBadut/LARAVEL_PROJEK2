<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderItems = OrderItem::with('order')->get();
        foreach($orderItems as $item){
            Review::factory()->create([
                'user_id' => $item->order->user_id,
                'produk_id' => $item->produk_id,
            ]);
        }
    }
}
