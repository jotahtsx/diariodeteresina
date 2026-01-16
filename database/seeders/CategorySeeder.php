<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Política', 'Polícia', 'Esportes', 'Cidades', 'Cultura'];

        foreach ($categories as $cat) {
            Category::create([
                'name'  => $cat,
                'slug'  => Str::slug($cat),
                'color' => '#f44336',
            ]);
        }
    }
}
