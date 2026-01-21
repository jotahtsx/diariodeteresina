<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Post extends Model
{
    /**
     * Campos permitidos para mass assignment
     */
    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'content',
        'image',
        'instagram_url',
        'telegram_message_id',
        'views',
    ];

    /**
     * Geração automática de slug único
     */
    protected static function booted()
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $slug = Str::slug($post->title);
                $count = static::where('slug', 'LIKE', "{$slug}%")->count();
                $post->slug = $count ? "{$slug}-" . ($count + 1) : $slug;
            }
        });

        static::updating(function (Post $post) {
            if ($post->isDirty('title')) {
                $slug = Str::slug($post->title);
                $count = static::where('slug', 'LIKE', "{$slug}%")
                    ->where('id', '!=', $post->id)
                    ->count();

                $post->slug = $count ? "{$slug}-" . ($count + 1) : $slug;
            }
        });
    }

    /**
     * Autor da notícia (User)
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Categoria da notícia
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Notícias relacionadas (mesma categoria)
     */
    public function relacionadas()
    {
        return $this->hasMany(
            self::class,
            'category_id',
            'category_id'
        );
    }
}
