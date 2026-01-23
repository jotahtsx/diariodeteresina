<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Polícia', 'color' => '#b91c1c'],
            ['name' => 'Política', 'color' => '#0f172a'],
            ['name' => 'Economia', 'color' => '#15803d'],
            ['name' => 'Cidades', 'color' => '#0369a1'],
            ['name' => 'Esporte', 'color' => '#ea580c'],
            ['name' => 'Cultura', 'color' => '#7e22ce'],
            ['name' => 'Saúde', 'color' => '#0d9488'],
            ['name' => 'Educação', 'color' => '#4338ca'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'color' => $cat['color'],
            ]);
        }
    }
}
