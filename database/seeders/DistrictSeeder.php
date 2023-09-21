<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            'Aveiro',
            'Beja',
            'Braga',
            'Bragança',
            'Castelo Branco',
            'Coimbra',
            'Évora',
            'Faro',
            'Guarda',
            'Leiria',
            'Lisboa',
            'Portalegre',
            'Porto',
            'Santarém',
            'Setúbal',
            'Viana do Castelo',
            'Vila Real',
            'Viseu',
        ];

        foreach ($districts as $district) {
            DB::table('districts')->insert([
                'name' => $district,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
