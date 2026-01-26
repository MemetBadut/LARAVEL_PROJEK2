<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(1)->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' =>  User::ROLE_ADMIN,
            'password' => Hash::make('adminmin'),
        ]);

        User::factory()->count(10)->create([
            'role' => User::ROLE_VENDOR,
            'password' => Hash::make('vendordor'),
        ]);

        User::factory()->count(100)->create([
            'role' => User::ROLE_CUSTOMER,
            'password' => Hash::make('userser'),
        ]);
    }
}
