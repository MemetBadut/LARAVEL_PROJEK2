<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('role', 'vendor')->get()->each(function ($user) {
            Vendor::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
