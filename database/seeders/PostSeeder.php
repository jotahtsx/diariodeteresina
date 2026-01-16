<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Author;
use App\Models\Category;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $author = Author::where('name', 'Jotah Dev')->first();
        $category = Category::where('slug', 'politica')->first();

        Post::create([
            'author_id'   => $author->id,
            'category_id' => $category->id,
            'title'       => 'Desenvolvimento do Novo Portal Diário de Teresina',
            'content'     => 'O sistema está sendo migrado para uma estrutura Laravel de alta performance...',
            'instagram_url' => 'https://www.instagram.com/diariodeteresina',
        ]);
    }
}
