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

    // Atributos padrão para novos registros
    protected $attributes = [
        'views' => 0,
        'is_highlight' => false,
        'is_featured' => false,
        'status' => 'rascunho',
    ];

    /**
     * Relacionamentos com "withDefault"
     * Isso evita erro de "property of non-object" no seu Blade.
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
            'name' => 'Autor Desconhecido',
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

    /**
     * Scope para buscar apenas o que está no ar.
     */
    public function scopePublished($query)
    {
        return $query->whereIn('status', ['published', 'postado'])
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}
