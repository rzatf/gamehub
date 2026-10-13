<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id', 'platform_id', 'normal_price', 'final_price',
        'discount_percent', 'currency', 'url', 'fetched_at',
    ];

    protected $casts = [
        'normal_price' => 'float',
        'final_price' => 'float',
        'fetched_at' => 'datetime',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
}
