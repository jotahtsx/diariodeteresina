<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\User; // <--- VAMOS USAR O USER
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $cities = City::all();
        
        // Buscamos apenas o editor que você criou no DatabaseSeeder
        $editor = User::where('email', 'editor@oracle.com')->first();

        if (!$editor) {
            $this->command->error("Editor Oracle não encontrado! Rode o DatabaseSeeder corretamente.");
            return;
        }

        $eyebrows = ['Justiça Social', 'Urgente', 'Política', 'Cultura', 'Esporte'];

        for ($i = 1; $i <= 60; $i++) {
            $title = fake()->sentence(rand(6, 10));
            $city = $cities->random();

            Post::create([
                'author_id'   => $editor->id, // <--- AQUI O ERRO MORRE. Usamos o ID 1 (ou o ID real do User)
                'category_id' => $categories->random()->id,
                'city_id'     => $city->id,
                'state_id'    => $city->state_id,
                'title'       => $title,
                'eyebrow'     => collect($eyebrows)->random(),
                'slug'        => Str::slug($title) . '-' . uniqid(),
                'content'     => fake()->paragraphs(5, true),
                'image'       => "https://picsum.photos/seed/".rand(1,100)."/800/600",
                'views'       => rand(10, 1000),
                'status'      => 'published',
                'is_featured' => ($i === 1),
            ]);
        }
    }
}