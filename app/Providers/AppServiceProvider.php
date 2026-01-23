<?php

namespace App\Providers;

use App\Models\Category; // Adicionado
use Illuminate\Support\Facades\Schema; // Adicionado
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Esta verificação evita que o comando 'php artisan' quebre
        // quando o banco de dados estiver vazio ou sendo reconstruído.
        if (! app()->runningInConsole()) {
            if (Schema::hasTable('categories')) {
                View::share('categories', Category::select('name', 'slug')
                    ->orderBy('name')
                    ->limit(6)
                    ->get());
            }
        }
    }
}
