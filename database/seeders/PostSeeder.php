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

        for ($i = 1; $i <= 60; $i++) {
            $title = fake()->sentence(rand(6, 10));

            // Sorteia uma cidade das 5 que você tem no banco
            $city = $cities->random();

            Post::create([
                'author_id' => $authors->random()->id,
                'category_id' => $categories->random()->id,
                'city_id' => $city->id, // <--- Aqui está o segredo
                'state_id' => $city->state_id,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . uniqid(),
                'content' => fake()->paragraphs(8, true),
                'image' => "https://picsum.photos/seed/" . rand(1, 1000) . "/1280/720",
                'views' => rand(100, 5000),
                'is_featured' => ($i === 1),
                'created_at' => now()->subMinutes(rand(1, 20000)),
                'status' => 'published',
            ]);
        }

        $this->command->info("60 posts criados com sucesso com cidades vinculadas!");
    }
}
