<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'steam_appid', 'description', 'developer', 'publisher', 'release_date',
        'rating', 'rating_count', 'cover_image', 'portrait_image', 'hero_image', 'wide_image',
        'min_requirements', 'rec_requirements', 'screenshots', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'release_date' => 'date',
        'rating' => 'float',
        'min_requirements' => 'array',
        'rec_requirements' => 'array',
        'screenshots' => 'array',
        'is_featured' => 'boolean',
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function priceHistories(): HasMany
    {
        return $this->hasMany(PriceHistory::class);
    }

    /** Cheapest current offer across platforms. */
    public function bestPrice(): ?Price
    {
        return $this->prices->sortBy('final_price')->first();
    }

    /** Highest discount currently available. */
    public function maxDiscount(): int
    {
        return (int) $this->prices->max('discount_percent');
    }
}
