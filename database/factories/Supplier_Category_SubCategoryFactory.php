<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier_Category_SubCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier_Category_SubCategory>
 */
class Supplier_Category_SubCategoryFactory extends Factory
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
            'id_category' => function ()
            {
                return \App\Models\Category::inRandomOrder()->first()->id;
            },
            'id_subCategory' => function ()
            {
                return \App\Models\SubCategory::inRandomOrder()->first()->id;
            },
            'startPrice' => $this->faker->randomFloat(2, 10, 1000),
            'endPrice' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
