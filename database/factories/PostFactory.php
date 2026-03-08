<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        // Usamos unique() para evitar que o Faker gere o mesmo título
        $title = $this->faker->unique()->sentence(rand(6, 10));
        $imgId = rand(1, 1000);

        return [
            // Dinâmico: se não houver user, ele cria um. Se houver, pega um aleatório.
            'author_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'title' => $title,
            // Adicionamos um pequeno sufixo aleatório no slug para evitar erros de Unique Constraint
            'slug' => Str::slug($title) . '-' . Str::lower(Str::random(4)),
            'eyebrow' => $this->faker->words(2, true), // Útil para o "chapéu" da notícia
            'excerpt' => $this->faker->sentence(15),   // O resumo que aparece na home
            'content' => $this->faker->paragraphs(8, true),
            'image' => "https://picsum.photos/id/{$imgId}/1280/720",
            'status' => 'published',
            'views' => $this->faker->numberBetween(100, 5000),
            'is_featured' => false,
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Estado para definir um post como destaque.
     */
    public function destaque(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
