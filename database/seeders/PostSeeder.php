<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $cities = City::all();
        $editor = User::where('email', 'editor@oracle.com')->first();

        if (! $editor) {
            $this->command->error("Editor Oracle não encontrado! Verifique o DatabaseSeeder.");

            return;
        }

        if ($categories->isEmpty() || $cities->isEmpty()) {
            $this->command->error("Certifique-se de que as categorias e cidades já foram populadas.");

            return;
        }

        // Criando 60 posts usando a Factory para um código mais limpo
        Post::factory(60)->make()->each(function ($post) use ($categories, $cities, $editor) {
            $city = $cities->random();
            $eyebrows = ['Justiça Social', 'Urgente', 'Política', 'Cultura', 'Esporte'];

            $post->fill([
                'author_id' => $editor->id,
                'category_id' => $categories->random()->id,
                'city_id' => $city->id,
                'state_id' => $city->state_id,
                'eyebrow' => collect($eyebrows)->random(),
                // 'slug' e 'title' já vêm prontos da Factory, mas você pode sobrescrever aqui se quiser
            ])->save();
        });

        // Garantindo que pelo menos 3 sejam destaques de forma randômica
        Post::inRandomOrder()->take(3)->update(['is_featured' => true]);

        $this->command->info("60 notícias do Pebas 40 Graus criadas com sucesso!");
    }
}
