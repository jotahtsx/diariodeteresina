<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'content',
        'image',
        'instagram_url',
    ];

    // O "Cérebro" do Slug Automático
    protected static function booted()
    {
        static::creating(function ($post) {
            // Se o slug não for enviado manualmente, ele gera a partir do título
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
