<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Social>
 */
class SocialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = \App\Models\Social::class;

    private $selectedProfiles = [];

    public function definition(): array
    {
        $profile = \App\Models\Profile::inRandomOrder()
            ->whereNotIn('id', $this->selectedProfiles)
            ->first();

        if ($profile) {
            $this->selectedProfiles[] = $profile->id;
            return [
                'id_profile' => $profile->id,
                'website' => $this->faker->url,
                'facebook' => $this->faker->url,
                'instagram' => $this->faker->url,
                'linkedin' => $this->faker->url,
            ];
        } else {
            // Handle the case where there are not enough unique suppliers.
            return [];
        }
    }
}
