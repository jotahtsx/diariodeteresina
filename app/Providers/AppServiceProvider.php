<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View; // <-- 1. ADICIONE ESTE IMPORT
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 2. REGISTRE O COMPONENTE AQUI (Isso resolve o erro do x-app-layout)
        Blade::component('layouts.app', 'app-layout');

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
