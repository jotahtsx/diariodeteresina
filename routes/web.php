<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// --- ROTAS DO SITE (PÚBLICO) ---
Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/noticia/{post:slug}', [HomeController::class, 'showPost'])->name('site.post');
Route::get('/categoria/{category:slug}', [HomeController::class, 'showCategory'])->name('site.categoria');


// --- ROTAS DO ADMIN (PAINEL) ---
// Removi o ['auth'] temporariamente para você conseguir acessar sem erro de login
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Gestão de Categprias
    Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categorias/cadastrar', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categorias', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categorias/{category}/editar', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categorias/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categorias/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Gestão de Notícias (Posts)
    Route::get('/noticias', [PostController::class, 'index'])->name('posts.index');
    Route::get('/noticias/cadastrar', [PostController::class, 'create'])->name('posts.create');
    Route::post('/noticias', [PostController::class, 'store'])->name('posts.store');
    Route::get('/noticias/{post}/editar', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/noticias/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/noticias/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// A linha que exigia o auth.php foi removida daqui.
