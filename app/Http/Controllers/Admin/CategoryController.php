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
        // Adicionamos o withCount para a coluna de notícias funcionar
        $categories = Category::withCount('posts')->orderBy('order', 'asc')->get();
        
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Exibe o formulário de criação (Nova Categoria)
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Salva uma nova categoria
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name',
            'order' => 'nullable|integer',
            'color' => 'nullable|string|max:7',
        ]);

        Category::create([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
            'order' => $request->order ?? 0,
            'color' => $request->color ?? '#1e40af',
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Exibe a página de edição
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Atualiza os dados no banco de dados
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name,' . $category->id,
            'order' => 'nullable|integer',
            'color' => 'nullable|string|max:7',
        ]);

        $category->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name),
            'order' => $request->order ?? 0,
            'color' => $request->color ?? '#1e40af',
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove a categoria com trava de segurança
     */
    public function destroy(Category $category)
    {
        // 1. Checa se existem posts vinculados
        $postCount = $category->posts()->count();

        if ($postCount > 0) {
            // 2. Se houver posts, cancela a operação e avisa o usuário
            $mensagem = "Não é possível deletar! Esta categoria possui {$postCount} " . ($postCount > 1 ? 'notícias vinculadas.' : 'notícia vinculada.');
            
            return redirect()->back()->with('error', $mensagem);
        }

        // 3. Se estiver vazia, deleta
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Categoria removida com sucesso!');
    }
}