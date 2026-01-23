<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post; // Verifique se este Model existe
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $authors = Author::all();

        // Se por algum motivo não houver autores, vamos criar um rápido para não quebrar
        if ($authors->isEmpty()) {
            $authors = collect([Author::create(['name' => 'Redação Oracle'])]);
        }

        for ($i = 1; $i <= 60; $i++) {
            $title = fake()->sentence(rand(6, 10));

            Post::create([
                'author_id' => $authors->random()->id, // O segredo está aqui
                'category_id' => $categories->random()->id,
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
    }
}
