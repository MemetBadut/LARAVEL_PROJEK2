<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alamat>
 */
class AlamatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'recipient_name' => fake('id_ID')->name(),
            'alamat_lengkap' => fake('id_ID')->address(),
            'daerah' => fake('id_ID')->citySuffix(),
            'kota' => fake('id_ID')->city(),
            'provinsi' => fake('id_ID')->state(),
            'kode_pos' => fake('id_ID')->postcode(),
        ];
    }
}
