<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post; // Importante para o create.blade
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Exibe a listagem de notícias
     */
    public function index()
    {
        // CORREÇÃO: O relacionamento no Model Post é 'category', não 'posts'.
        $posts = Post::with('category')->latest()->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Salva a notícia com upload de imagem e slug
     */
    public function store(Request $request)
    {
        // 1. Validação Ajustada
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // mudei para nullable caso queira editar depois
            'status' => 'required|in:published,postado,draft,rascunho', // Ajustado para aceitar seu novo padrão
        ]);

        // 2. Tratamento da Imagem
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Sugestão: usar o título no nome do arquivo ajuda no SEO
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = Str::slug($validated['title']) . '-' . time() . '.' . $extension;
            $imagePath = $request->file('image')->storeAs('posts', $fileName, 'public');
        }

        // 3. Criação do Post
        Post::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::lower(Str::random(5)),
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'author_id' => Auth::id(),
            'image' => $imagePath,
            'status' => $validated['status'],
            'eyebrow' => $request->eyebrow, // Adicionado para não perder o campo da migration
            'excerpt' => $request->excerpt, // Adicionado para não perder o campo da migration
            'is_featured' => $request->has('is_featured'), // Checkbox do formulário
            'is_highlight' => $request->has('is_highlight'), // Checkbox do formulário
            'views' => 0,
            'published_at' => now(),
        ]);

        return redirect()->route('admin.posts.index')
                         ->with('success', 'Notícia publicada com sucesso!');
    }
}
