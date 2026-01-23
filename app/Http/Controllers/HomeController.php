<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Pega o Destaque (Prioriza is_featured, senão pega o último publicado)
        $postDestaque = Post::with('category')
            ->where('status', 'published')
            ->where('is_featured', true)
            ->latest()
            ->first()
            ??
            Post::with('category')
            ->where('status', 'published')
            ->latest()
            ->first();

        if (! $postDestaque) {
            return view('site.home');
        }

        // 2. Pegamos os 3 principais seguintes (excluindo o destaque)
        $postsPrincipais = Post::with('category')
            ->where('status', 'published')
            ->where('id', '!=', $postDestaque->id)
            ->latest()
            ->take(3)
            ->get();

        // 3. Pegamos os IDs para não repetir notícias
        $idsUsados = array_merge([$postDestaque->id], $postsPrincipais->pluck('id')->toArray());

        // 4. Pegamos o restante das notícias
        $postsRestante = Post::with('category')
            ->where('status', 'published')
            ->whereNotIn('id', $idsUsados)
            ->latest()
            ->take(14)
            ->get();

        $hasLiveGames = true;

        return view('site.home', compact('postDestaque', 'postsPrincipais', 'postsRestante', 'hasLiveGames'));
    }

    public function showPost(Post $post)
    {
        // Incrementa visualizações ao abrir a notícia
        $post->increment('views');

        $post->load(['category']); // Removi 'author' caso não esteja usando ainda para evitar erros

        return view('site.post', compact('post'));
    }

    public function showCategory(Category $category)
    {
        $posts = Post::with(['category'])
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(9);

        return view('site.category', compact('category', 'posts'));
    }
}
