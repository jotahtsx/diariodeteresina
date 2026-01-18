<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Sua lista original de strings
        $categories = ['Política', 'Polícia', 'Esportes', 'Cidades', 'Cultura'];

        // Cores padrão para o Portal
        $colors = [
            'Política' => '#0000CC',
            'Polícia'  => '#CC0000',
            'Esportes' => '#006600',
            'Cidades'  => '#666666',
            'Cultura'  => '#FF9900'
        ];

        foreach ($categories as $categoryName) {
            Category::updateOrCreate(
                ['slug' => Str::slug($categoryName)], // Transforma "Política" em "politica"
                [
                    'name'  => $categoryName,
                    'color' => $colors[$categoryName] ?? '#333333' // Usa a cor definida ou um cinza escuro
                ]
            );
        }
    }
}
