<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Full game payload for the game-detail page (about, system requirements,
 * per-platform offers and the 6-month price history chart).
 */
class GameDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $prices = $this->prices->sortBy('final_price')->values();
        $best = $prices->first();
        $cheapestFinal = $best ? (float) $best->final_price : null;

        $history = $this->priceHistories
            ->sortBy(fn ($h) => $h->recorded_on->timestamp)
            ->groupBy(fn ($h) => $h->recorded_on->format('Y-m'));

        $months = $history->keys()->values();
        // Indonesian month abbreviations, matching the design's chart axis.
        $idMonths = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
        $labels = $months->map(fn ($m) => $idMonths[(int) substr($m, 5, 2)] ?? $m)->values();

        // Full date of each monthly data point, so the chart tooltip can show a
        // real date instead of just the axis abbreviation (PRD: "tooltip
        // menampilkan tanggal dan harga").
        $dates = $months->map(function ($m) use ($history) {
            $row = $history->get($m)?->first();

            return $row ? $row->recorded_on->toDateString() : null;
        })->values();

        $seriesByPlatform = [];
        foreach ($prices as $p) {
            $platformSlug = $p->platform?->slug;
            $key = $platformSlug ?: 'unknown';
            $normal = [];
            $final = [];
            $discount = [];
            foreach ($months as $m) {
                $row = $history->get($m)?->firstWhere('platform_id', $p->platform_id);
                $normal[] = $row ? (float) $row->normal_price : null;
                $final[] = $row ? (float) $row->final_price : null;
                $discount[] = $row ? (int) $row->discount_percent : null;
            }
            $finals = array_values(array_filter($final, fn ($v) => $v !== null));
            $minSix = $finals ? min($finals) : null;

            $seriesByPlatform[] = [
                'platform' => [
                    'name' => $p->platform?->name,
                    'slug' => $platformSlug,
                    'color' => $p->platform?->color,
                ],
                'normal' => $normal,
                'final' => $final,
                'discount' => $discount,
                'min_6_months' => $minSix,
                'is_lowest_6_months' => $minSix !== null && $cheapestFinal !== null && $cheapestFinal <= $minSix,
            ];
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'steam_appid' => $this->steam_appid,
            'steam_url' => $this->steam_appid ? "https://store.steampowered.com/app/{$this->steam_appid}/" : null,
            'description' => $this->description,
            'developer' => $this->developer,
            'publisher' => $this->publisher,
            'release_date' => $this->release_date?->toDateString(),
            'release_year' => $this->release_date ? (int) $this->release_date->format('Y') : null,
            'rating' => round((float) $this->rating, 1),
            'rating_count' => $this->rating_count,
            'cover_image' => $this->cover_image,
            'portrait_image' => $this->portrait_image,
            'hero_image' => $this->hero_image,
            'wide_image' => $this->wide_image,
            'screenshots' => $this->screenshots ?? [],
            'genres' => $this->genres->pluck('name')->values(),
            'genre_slugs' => $this->genres->pluck('slug')->values(),
            'min_requirements' => $this->min_requirements ?? [],
            'rec_requirements' => $this->rec_requirements ?? [],
            'normal_price' => $best ? (float) $best->normal_price : null,
            'final_price' => $cheapestFinal,
            'discount_percent' => $best ? (int) $best->discount_percent : 0,
            'best_platform' => $best && $best->platform ? [
                'name' => $best->platform->name,
                'slug' => $best->platform->slug,
                'color' => $best->platform->color,
            ] : null,
            'prices' => $prices->map(fn ($p) => [
                'name' => $p->platform?->name,
                'slug' => $p->platform?->slug,
                'color' => $p->platform?->color,
                'normal_price' => (float) $p->normal_price,
                'final_price' => (float) $p->final_price,
                'discount_percent' => (int) $p->discount_percent,
                'url' => $p->url,
                'is_lowest' => $cheapestFinal !== null && (float) $p->final_price === $cheapestFinal,
            ])->values(),
            'history' => [
                'months' => $months,
                'labels' => $labels,
                'dates' => $dates,
                'series' => $seriesByPlatform,
                'min_6_months' => $seriesByPlatform ? min(array_filter(array_column($seriesByPlatform, 'min_6_months'), fn ($v) => $v !== null)) : null,
                'is_lowest_6_months' => (bool) ($seriesByPlatform[0]['is_lowest_6_months'] ?? false),
            ],
        ];
    }
}
