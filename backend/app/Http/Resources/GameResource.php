<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Compact game payload used by grids, carousels and search results.
 */
class GameResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $prices = $this->prices->sortBy('final_price')->values();
        $best = $prices->first();

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'cover_image' => $this->cover_image,
            'portrait_image' => $this->portrait_image,
            'rating' => round((float) $this->rating, 1),
            'rating_count' => $this->rating_count,
            'release_year' => $this->release_date ? (int) $this->release_date->format('Y') : null,
            'is_featured' => (bool) $this->is_featured,
            'genres' => $this->genres->pluck('name')->values(),
            'genre_slugs' => $this->genres->pluck('slug')->values(),
            'normal_price' => $best ? (float) $best->normal_price : null,
            'final_price' => $best ? (float) $best->final_price : null,
            'discount_percent' => $best ? (int) $best->discount_percent : 0,
            'max_discount_percent' => (int) ($prices->max('discount_percent') ?? 0),
            'best_platform' => $best && $best->platform ? [
                'name' => $best->platform->name,
                'slug' => $best->platform->slug,
                'color' => $best->platform->color,
            ] : null,
            'platform_count' => $prices->count(),
            'platforms' => $prices->map(fn ($p) => [
                'name' => $p->platform?->name,
                'slug' => $p->platform?->slug,
                'color' => $p->platform?->color,
                'normal_price' => (float) $p->normal_price,
                'final_price' => (float) $p->final_price,
                'discount_percent' => (int) $p->discount_percent,
                'url' => $p->url,
            ])->values(),
        ];
    }
}
