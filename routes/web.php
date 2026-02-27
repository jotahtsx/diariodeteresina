<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('site.home');

// Notícia Individual
Route::get('/noticia/{post:slug}', [HomeController::class, 'showPost'])->name('site.post');

// Categorias
Route::get('/categoria/{category:slug}', [HomeController::class, 'showCategory'])->name('site.categoria');


Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
