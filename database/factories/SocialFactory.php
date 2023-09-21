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

    private $selectedSuppliers = [];

    public function definition(): array
    {
        $supplier = \App\Models\Supplier::inRandomOrder()
            ->whereNotIn('id', $this->selectedSuppliers)
            ->first();

        if ($supplier) {
            $this->selectedSuppliers[] = $supplier->id;
            return [
                'id_supplier' => $supplier->id,
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
