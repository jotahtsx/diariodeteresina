<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa.
     * Isso evita o erro de "Mass Assignment".
     */
    protected $fillable = [
        'name',
        'slug',
        'color',
        'order',
    ];

    /**
     * Relacionamento: Uma categoria tem muitos Posts.
     * Isso permite usar o withCount('posts') no Controller.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
