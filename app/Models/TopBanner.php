<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopBanner extends Model
{
protected $fillable = ['titulo', 'confronto', 'code', 'is_active', 'cor_fundo', 'position'];
}
