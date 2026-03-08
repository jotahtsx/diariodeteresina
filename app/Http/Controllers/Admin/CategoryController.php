<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Lista as categorias ordenadas com contagem de posts
     */
    public function index()
    {
        $categories = Category::withCount('posts')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Salva uma nova categoria
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'order' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:7',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'order' => $validated['order'] ?? 0,
            // Garante que a cor salve sempre em maiúsculo e com #
            'color' => $validated['color'] ? strtoupper($validated['color']) : '#1E40AF',
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Atualiza os dados no banco de dados
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'order' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:7',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'order' => $validated['order'] ?? 0,
            'color' => $validated['color'] ? strtoupper($validated['color']) : '#1E40AF',
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove a categoria com trava de segurança reforçada
     */
    public function destroy(Category $category)
    {
        // exists() é mais rápido que count() para checagem simples
        if ($category->posts()->exists()) {
            $postCount = $category->posts()->count();
            $mensagem = "Ação bloqueada! Esta categoria possui {$postCount} " . ($postCount > 1 ? 'postagens vinculadas.' : 'postagem vinculada.');

            return redirect()->back()->with('error', $mensagem);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Categoria removida com sucesso!');
    }
}
