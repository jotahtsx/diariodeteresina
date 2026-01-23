<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Destaque
        $postDestaque = Post::with(['category', 'city'])
            ->where('status', 'published')
            ->latest()
            ->first();

        if (! $postDestaque) {
            return view('site.home');
        }

        // 2. Principais (3)
        $postsPrincipais = Post::with(['category', 'city'])
            ->where('status', 'published')
            ->where('id', '!=', $postDestaque->id)
            ->latest()
            ->take(3)
            ->get();

        $idsUsados = array_merge([$postDestaque->id], $postsPrincipais->pluck('id')->toArray());

        // 3. Notícias das Cidades (4)
        $postsCidades = Post::with(['category', 'city'])
            ->where('status', 'published')
            ->whereNotNull('city_id')
            ->whereNotIn('id', $idsUsados)
            ->latest()
            ->take(4)
            ->get();

        $idsUsados = array_merge($idsUsados, $postsCidades->pluck('id')->toArray());

        // 4. Restante das notícias
        $postsRestante = Post::with(['category', 'city'])
            ->where('status', 'published')
            ->whereNotIn('id', $idsUsados)
            ->latest()
            ->take(14)
            ->get();

        // --- BUSCA DOS BANNERS (O QUE ESTAVA FALTANDO) ---
        // Aqui assumimos que sua tabela 'top_banners' tem uma coluna 'position' ou similar.
        // Se não tiver, buscamos os dois primeiros disponíveis como teste:
        $banners = \App\Models\TopBanner::all();
        $adHeader = $banners->where('position', 'header')->first();
        $adFooter = $banners->where('position', 'footer')->first();

        $hasLiveGames = false;

        return view('site.home', compact(
            'postDestaque',
            'postsPrincipais',
            'postsCidades',
            'postsRestante',
            'adHeader',
            'adFooter',
            'hasLiveGames'
        ));
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
