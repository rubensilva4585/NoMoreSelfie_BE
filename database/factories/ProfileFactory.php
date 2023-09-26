<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\District;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'district_id' => District::all()->random()->id,
            'date_of_birth' => $this->faker->date,
            'phone' => rand(910000000, 999999999),
            'company' => $this->faker->company,
            'nif' => rand(100000000, 999999999), 
            'address' => $this->faker->address,
            'bio' => $this->faker->paragraph,
        ];
    }
}
