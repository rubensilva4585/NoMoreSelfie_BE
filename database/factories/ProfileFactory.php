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
    private $selectedUsers = [];

    public function definition(): array
    {
        $user = \App\Models\User::inRandomOrder()
            ->whereNotIn('id', $this->selectedUsers)
            ->first();

        if ($user) {
            $this->selectedUsers[] = $user->id;
            return [
                'user_id' => $user->id,
                'district_id' => District::all()->random()->id,
                'date_of_birth' => $this->faker->date,
                'phone' => rand(910000000, 999999999),
                'company' => $this->faker->company,
                'nif' => rand(100000000, 999999999),
                'address' => $this->faker->address,
                'bio' => $this->faker->paragraph,
            ];
        } else {
            // Handle the case where there are not enough unique suppliers users.
            return [];
        }
    }
}
