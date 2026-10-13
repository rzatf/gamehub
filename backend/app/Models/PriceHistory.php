<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id', 'platform_id', 'recorded_on',
        'normal_price', 'final_price', 'discount_percent',
    ];

    protected $casts = [
        'recorded_on' => 'date',
        'normal_price' => 'float',
        'final_price' => 'float',
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
