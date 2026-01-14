<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@example.com')->first();
        if(!$user){
            return;
        }

        Alamat::factory()->create([
            'user_id' => $user->id,
            'recipient_name' => $user->name,
        ]);
    }
}
