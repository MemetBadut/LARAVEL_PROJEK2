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
        User::chunk(100, function($users){
            foreach($users as $user){
                if($user->addresses()->exists()){
                    continue;
                }

                Alamat::factory()->create([
                    'user_id' => $user->id,
                    'recipient_name' => $user->name,
                    'is_default' => true,
                ]);
            }
        });
    }
}
