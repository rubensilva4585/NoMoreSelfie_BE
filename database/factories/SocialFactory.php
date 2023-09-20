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
    public function definition(): array
    {
        return [
            'id_supplier' => function ()
            {    
                return \App\Models\Supplier::inRandomOrder()->first()->id;
            },
            'website' => $this->faker->url,
            'facebook' => $this->faker->url,
            'instagram' => $this->faker->url,
            'linkedin' => $this->faker->url,
        ];
    }
}
