<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(rand(6, 10));
        $imgId = rand(1, 1000);

        return [
            'author_id' => User::first()?->id ?? 1,
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(6, true),
            'image' => "https://picsum.photos/id/{$imgId}/1280/720",
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
