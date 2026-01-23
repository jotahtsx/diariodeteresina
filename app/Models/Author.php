<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Author extends Model
{
    protected $fillable = ['name', 'avatar', 'bio', 'city', 'state'];

    // O Filament está procurando por isso aqui:
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    protected static function booted()
    {
        static::deleting(function ($author) {
            if ($author->avatar) {
                Storage::disk('public')->delete($author->avatar);
            }
        });
    }
}
