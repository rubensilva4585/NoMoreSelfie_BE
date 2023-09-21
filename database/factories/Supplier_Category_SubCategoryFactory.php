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
        $supplier = \App\Models\Supplier::inRandomOrder()->first();
        $category = \App\Models\Category::inRandomOrder()->first();
        $subCategory = \App\Models\SubCategory::where('id_category', $category->id)->inRandomOrder()->first();
        $existingRecord = Supplier_Category_SubCategory::where([
            'id_supplier' => $supplier->id,
            'id_category' => $category->id,
            'id_subCategory' => $subCategory->id,
        ])->first();
        if ($existingRecord)
        {
            return [];
        }

        return [
            'id_supplier' => $supplier->id,
            'id_category' => $category->id,
            'id_subCategory' => $subCategory->id,
            'startPrice' => $this->faker->randomFloat(2, 10, 1000),
            'endPrice' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}