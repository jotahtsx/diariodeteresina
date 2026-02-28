<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'author_id', 'city_id', 'state_id',
        'title', 'slug', 'eyebrow', 'excerpt', 'content',
        'image', 'instagram_url', 'status', 'is_featured', 'views',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime', // Adicione se estiver na sua migration
    ];

    // Relacionamento com a Categoria (O que permite o count lá na Index)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author(): BelongsTo
    {
        // Verifique se o nome do model é Author ou User
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}