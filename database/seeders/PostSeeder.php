<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $authors = Author::all();
        $cities = City::all();

        // Se não houver cidades, o seeder para aqui com um aviso
        if ($cities->isEmpty()) {
            $this->command->warn("Nenhuma cidade encontrada. Rode o CitySeeder antes!");

            return;
        }

        // Lista de expressões para as Tags de Chamada (Eyebrows)
        // Elas aparecerão com 18px e font-black no seu site
        $eyebrows = [
            'Justiça Social', 'Urgente', 'Política de Base', 'Cultura Local',
            'Saúde Pública', 'Educação', 'Meio Ambiente', 'Vozes da Comunidade',
            'Esporte Amador', 'Economia Popular', 'Segurança', 'Mobilidade Urbana',
            'Direitos Humanos', 'Luta Sindical', 'Desenvolvimento', 'Cidadania',
        ];

        for ($i = 1; $i <= 60; $i++) {
            $title = fake()->sentence(rand(6, 10));
            $city = $cities->random();

            Post::create([
                'author_id' => $authors->random()->id,
                'category_id' => $categories->random()->id,
                'city_id' => $city->id,
                'state_id' => $city->state_id,
                'title' => $title,

                // Sorteia um eyebrow da lista.
                // Colocamos uma chance de 10% de vir nulo para testar seu fallback "chamada"
                'eyebrow' => rand(1, 10) > 1 ? collect($eyebrows)->random() : null,

                'slug' => Str::slug($title) . '-' . uniqid(),
                'content' => fake()->paragraphs(8, true),
                'image' => "https://picsum.photos/seed/" . rand(1, 1000) . "/1280/720",
                'views' => rand(100, 5000),
                'is_featured' => ($i === 1),
                'created_at' => now()->subMinutes(rand(1, 20000)),
                'status' => 'published',
            ]);
        }

        $this->command->info("60 posts criados com sucesso! Tags de chamada (eyebrows) integradas ao novo layout.");
    }
}
