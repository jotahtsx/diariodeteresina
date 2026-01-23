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
        'author_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'instagram_url',
        'telegram_message_id',
        'views',
        'is_featured',
        'status', // <--- Faltava este carinha aqui!
    ];

    protected static function booted()
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $slug = Str::slug($post->title);
                // Usando uniqid para garantir que slugs em latim repetidos não quebrem o seeder
                $post->slug = $slug . '-' . uniqid();
            }
        });
    }

    /**
     * IMPORTANTE: Sua migration criou a tabela 'authors'.
     * Verifique se a relação é com o Model Author ou User.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
