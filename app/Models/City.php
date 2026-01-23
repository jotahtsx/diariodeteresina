<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Adicione esta linha

class City extends Model
{
    protected $fillable = ['state_id', 'name', 'slug'];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
