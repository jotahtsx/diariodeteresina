<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'author_id',
        'city_id',
        'state_id',
        'title',
        'slug',
        'eyebrow',
        'excerpt',
        'content',
        'image',
        'instagram_url',
        'status',
        'is_featured',
        'views',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'views' => 'integer',
        'status' => 'string',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }
	
	public function posts()
	{
		return $this->hasMany(Post::class);
	}
}
