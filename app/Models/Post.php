<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'author_id',
        'city_id',
        'state_id',
        'title',
        'slug',
        'status',
        'eyebrow',
        'excerpt',
        'content',
        'image',
        'is_highlight',
        'is_featured',
        'views',
        'published_at',
    ];

    protected $casts = [
        'is_highlight' => 'boolean',
        'is_featured' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime',
    ];

    // Valores padrão para evitar campos nulos no banco
    protected $attributes = [
        'views' => 0,
        'is_highlight' => false,
        'is_featured' => false,
        'status' => 'rascunho',
    ];

    /**
     * MÁGICA: Eventos do Model
     * Gera o slug automaticamente antes de salvar se estiver vazio.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * ACESSOR: URL da Imagem
     * Retorna a URL completa ou um placeholder se não houver foto.
     * Uso no Blade: {{ $post->image_url }}
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return asset('images/placeholder-noticia.jpg');
    }

    /**
     * ACESSOR: Tempo de Leitura Estimado
     * Uso no Blade: {{ $post->reading_time }} min de leitura
     */
    public function getReadingTimeAttribute()
    {
        $minutes = ceil(str_word_count(strip_tags($this->content)) / 200);

        return $minutes > 0 ? $minutes : 1;
    }

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Sem Categoria',
            'color' => '#cbd5e1',
        ]);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id')->withDefault([
            'name' => 'Redação Pebas 40º',
        ]);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes (Filtros de Busca)
    |--------------------------------------------------------------------------
    */

    /**
     * Busca apenas o que já foi publicado e cuja data já passou.
     */
    public function scopePublished($query)
    {
        return $query->whereIn('status', ['published', 'postado'])
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now())
                     ->orderBy('published_at', 'desc');
    }

    /**
     * Busca apenas notícias em destaque.
     */
    public function scopeHighlighted($query)
    {
        return $query->where('is_highlight', true);
    }
}
