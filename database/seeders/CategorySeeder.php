<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Casamentos',
            'Bebés',
            'Edição',
            'Drone',
            'Festas',
            'Eventos Empresariais',
            'Restauração',
            'Turismo',
            'Moda',
            'Lazer',
            'Imoveis',
            'Desporto',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'inPerson' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
