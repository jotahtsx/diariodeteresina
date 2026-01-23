<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        // Lista focada na região e editorias principais
        $categories = [
            'Política' => '#4A90E2', // Azul
            'Polícia' => '#E57373', // Vermelho Suave
            'Piauí' => '#4DB6AC', // Verde Água
            'Municípios' => '#7986CB', // Indigo
            'Ceará' => '#F06292', // Rosa/Vinho Suave
            'Maranhão' => '#FFB74D', // Laranja
            'Esportes' => '#81C784', // Verde
        ];

        foreach ($categories as $name => $color) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'color' => $color,
            ]);
        }
    }
}
