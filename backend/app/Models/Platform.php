<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'logo', 'color', 'store_url', 'show_on_home', 'sort_order'];

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }
}
