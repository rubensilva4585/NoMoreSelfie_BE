<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserSubCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSubCategory>
 */
class UserSubCategoryFactory extends Factory
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

        $profile = \App\Models\Profile::inRandomOrder()->first();

        if ($user) {
            $this->selectedUsers[] = $user->id;

            return [
                'user_id' => $user->id,
                'profile_id' => $profile->id,
                'startPrice' => $this->faker->randomFloat(2, 10, 1000),
                'endPrice' => $this->faker->randomFloat(2, 10, 1000),
            ];

        } else {
            // Handle the case where there are not enough unique suppliers users.
            return [];
        }
    }
}
