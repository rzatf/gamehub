<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'badge', 'image', 'platform_id', 'url',
        'starts_at', 'ends_at', 'sort_order',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }
}
