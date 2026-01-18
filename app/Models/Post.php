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

    protected static function booted()
    {
        parent::boot();
        static::creating(function ($post) {
            $slug = Str::slug($post->title);
            $count = static::where('slug', 'LIKE', "{$slug}%")->count();
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
