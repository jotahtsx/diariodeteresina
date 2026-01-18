<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Author;
use Illuminate\Database\Seeder;

class PortalStructureSeeder extends Seeder
{
    public function run(): void
    {
        // Categorias do Portal - Usando updateOrCreate para não duplicar
        $categorias = [
            ['name' => 'Policial', 'slug' => 'policial', 'color' => '#CC0000'],
            ['name' => 'Política', 'slug' => 'politica', 'color' => '#0000CC'],
            ['name' => 'Economia', 'slug' => 'economia', 'color' => '#006600'],
            ['name' => 'Cotidiano', 'slug' => 'cotidiano', 'color' => '#666666'],
            ['name' => 'Esporte', 'slug' => 'esporte', 'color' => '#FF9900'],
        ];

        foreach ($categorias as $categoria) {
            // Se o slug já existir, ele só atualiza o nome e a cor (reescreve)
            Category::updateOrCreate(
                ['slug' => $categoria['slug']], 
                [
                    'name' => $categoria['name'],
                    'color' => $categoria['color']
                ]
            );
        }

        // Primeiro integrante da equipe de jornalismo
        // Também usamos updateOrCreate pelo nome para evitar erros se rodar o seeder 2x
        Author::updateOrCreate(
            ['name' => 'Equipe de Jornalismo'],
            [
                'city' => 'Teresina',
                'state' => 'PI'
            ]
        );
    }
}
