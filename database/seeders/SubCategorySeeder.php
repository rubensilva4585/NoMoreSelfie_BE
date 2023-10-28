<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryMappings = [
            'Casamentos' => [
                'Pedido de Casamento',
                'Pré Casamento',
                'Pós Casamento',
                'Casamento',
            ],
            'Bebés' => [
                'Sessão Newborn',
                'Ensaio de Gravidez',
                'Chá Revelação',
                'Baby Shower',
                'Álbum de Bebé',
                'Batizado',
            ],
            'Edição' => [
                'Edição de Vídeo',
                'Edição de Fotografia',
                'Pós-Produção',
                'Efeitos Especiais',
            ],
            'Drone' => [
                'Fotografia Aérea',
                'Vídeo Aéreo',
                'Mapeamento com Drone',
                'Inspeção com Drone',
            ],
            'Festas' => [
                'Aniversário',
                'Temáticas',
                'Despedida de Solteiro(a)',
                'Natal',
                'Ano Novo',
            ],
            'Eventos Empresariais' => [
                'Conferências',
                'Seminários',
                'Lançamentos de Produtos',
                'Eventos Corporativos',
                'Feiras Comerciais',
            ],
            'Restauração' => [
                'Fotografia de Alimentos',
                'Fotografia de Ambiente',
                'Cardápio',
                'Vídeo Promocional de Restaurante',
                'Chef em Ação',
            ],
            'Turismo' => [
                'Fotografia de Destinos',
                'Vídeo de Viagens',
                'Fotografia de Natureza',
            ],
            'Moda' => [
                'Ensaio de Moda',
                'Desfiles de Moda',
                'Fotografia de Catálogos',
                'Editoriais de Moda',
            ],
            'Lazer' => [
                'Shows e Concertos',
                'Parques de Diversões',
                'Viagens de Lazer',
            ],
            'Imóveis' => [
                'Fotografia de Imóveis',
                'Vídeo de Imóveis',
                'Tour Virtual',
            ],
            'Desporto' => [
                'Cobertura de Eventos desportivos',
                'Retratos de Atletas',
                'Vídeo de Treino',
                'Desportos Radicais',
            ],
        ];

        foreach ($categoryMappings as $categoryName => $subcategories) {
            $categoryId = DB::table('categories')->where('name', $categoryName)->value('id');

            foreach ($subcategories as $subcategory) {
                DB::table('sub_categories')->insert([
                    'category_id' => $categoryId,
                    'name' => $subcategory,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
