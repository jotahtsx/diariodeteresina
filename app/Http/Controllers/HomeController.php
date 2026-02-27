<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\TopBanner;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Destaque Principal
        $postFeature = Post::with(['category', 'city'])
            ->where('status', 'published')
            ->latest()
            ->first();

        if (!$postFeature) {
            return view('site.home');
        }

        // 2. Notícias Principais (3 logo abaixo do destaque)
        $postFeatures = Post::with(['category', 'city'])
            ->where('status', 'published')
            ->where('id', '!=', $postFeature->id)
            ->latest()
            ->take(3)
            ->get();

        $idsUsados = array_merge([$postFeature->id], $postFeatures->pluck('id')->toArray());

        // 3. Notícias das Cidades (4 no grid inferior)
        $postCities  = Post::with(['category', 'city'])
            ->where('status', 'published')
            ->whereNotNull('city_id')
            ->whereNotIn('id', $idsUsados)
            ->latest()
            ->take(4)
            ->get();

        $idsUsados = array_merge($idsUsados, $postCities ->pluck('id')->toArray());

        // 4. Restante das notícias (O seu layout usa slice para distribuir no grid)
        $postsRestante = Post::with(['category', 'city'])
            ->where('status', 'published')
            ->whereNotIn('id', $idsUsados)
            ->latest()
            ->take(14)
            ->get();

        // 5. Busca dos Banners Publicitários
        // Sua view usa $adHeader->code, então garantimos que ele pegue o registro correto
        $adHeader = TopBanner::where('position', 'header')->where('is_active', true)->first();
        $adFooter = TopBanner::where('position', 'footer')->where('is_active', true)->first();

        // 6. Alertas de "Ao Vivo" (Lutas, BBB, Jogos)
        // Como sua View usa cache('has_live_fights'), você pode definir aqui para teste:
        // Cache::put('has_live_fights', true, 60); 
        // Cache::put('fight_title', 'ACOMPANHE O PAREDÃO AO VIVO', 60);

        return view('site.home', compact(
            'postFeature',
            'postFeatures',
            'postCities',
            'postsRestante',
            'adHeader',
            'adFooter'
        ));
    }
    
    // ... manter showPost e showCategory como estão
}