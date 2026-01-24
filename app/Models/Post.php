<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Importação essencial

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'author_id',
        'city_id',
        'state_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'instagram_url',
        'status',
        'is_featured',
        'views',
    ];

    /**
     * Relação com o Autor
     * Explicitamos o 'author_id' para não haver erro de busca
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    /**
     * Relação com a Categoria
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relação com a Cidade
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Relação com o Estado
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
