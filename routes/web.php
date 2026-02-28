<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

// --- ROTAS DO SITE (PÚBLICO) ---
Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('/noticia/{post:slug}', [HomeController::class, 'showPost'])->name('site.post');
Route::get('/categoria/{category:slug}', [HomeController::class, 'showCategory'])->name('site.categoria');


// --- ROTAS DO ADMIN (PAINEL) ---
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
	
// Gestão de Categorias
    Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categorias/cadastrar', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categorias', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categorias/{category}/editar', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categorias/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categorias/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});