<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // Puxamos os posts com as relações (Eager Loading)
        $posts = Post::with(['author', 'category'])
            ->latest()
            ->paginate(9);

        // Definimos se o placar de jogos deve aparecer
        $hasLiveGames = false;

        return view('site.home', compact('posts', 'hasLiveGames'));
    }

    public function showPost(Post $post)
    {
        $post->load(['author', 'category']);

        return view('site.posts.post', compact('post'));
    }

    public function showCategory(Category $category)
    {
        $posts = Post::with(['author', 'category'])
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(9);

        return view('site.category.index', compact('category', 'posts'));
    }
}
