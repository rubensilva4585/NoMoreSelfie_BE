<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;
use App\Models\District;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password123'), // Defina sua senha padrão aqui
            'id_district' => District::all()->random()->id,
            'phone' => rand(910000000, 999999999),
            'company' => $this->faker->company,
            'nif' => rand(100000000, 999999999),
            'address' => $this->faker->address,
            'bio' => $this->faker->paragraph,
        ];
    }
}
