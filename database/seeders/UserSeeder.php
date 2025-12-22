<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFactory::factory()->count()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' =>  User::ROLE_ADMIN,
        ]);

        UserFactory::factory()->count(10)->create([
            'role' => User::ROLE_VENDOR,
        ]);

        UserFactory::factory()->count(100)->create([
            'role' => User::ROLE_CUSTOMER,
        ]);
    }
}
