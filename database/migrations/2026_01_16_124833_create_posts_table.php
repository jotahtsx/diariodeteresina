<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'status', // Agora padrão 'postado' ou 'rascunho'
        'eyebrow',
        'excerpt',
        'content',
        'image',
        'is_highlight', // Adicionado para casar com a migration
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

    // Relacionamentos (Mantidos e conferidos)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Scope para pegar apenas notícias no ar.
     * Ajustei para aceitar 'published' (antigos) e 'postado' (novos)
     */
    public function scopePublished($query)
    {
        return $query->whereIn('status', ['published', 'postado'])
                     ->where('published_at', '<=', now());
    }
}
