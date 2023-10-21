<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserSubCategory;
use Illuminate\Support\Facades\DB;

class UserSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_sub_categories')->insert([
            'user_id' => 1,
            'subcategory_id' => 1,
            'startPrice' => 500,
            'endPrice' => 700,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('user_sub_categories')->insert([
            'user_id' => 1,
            'subcategory_id' => 2,
            'startPrice' => 500,
            'endPrice' => 700,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('user_sub_categories')->insert([
            'user_id' => 1,
            'subcategory_id' => 3,
            'startPrice' => 500,
            'endPrice' => 700,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('user_sub_categories')->insert([
            'user_id' => 1,
            'subcategory_id' => 4,
            'startPrice' => 500,
            'endPrice' => 700,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('user_sub_categories')->insert([
            'user_id' => 1,
            'subcategory_id' => 5,
            'startPrice' => 500,
            'endPrice' => 700,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('user_sub_categories')->insert([
            'user_id' => 1,
            'subcategory_id' => 6,
            'startPrice' => 500,
            'endPrice' => 700,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // UserSubCategory::factory()->count(50)->create();
    }
}
