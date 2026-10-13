<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\Platform;
use App\Models\SaleEvent;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * GET /api/home
     * Everything the landing page needs: sale-event banners plus one
     * carousel section per store, each holding the featured deals.
     */
    public function __invoke(): JsonResponse
    {
        $featured = Game::query()
            ->with(['genres', 'prices.platform'])
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->limit(10)
            ->get();

        $fallback = $featured->isEmpty()
            ? Game::query()->with(['genres', 'prices.platform'])->orderByDesc('rating_count')->limit(8)->get()
            : $featured;

        $sections = Platform::query()
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn (Platform $p) => [
                'title' => $p->slug === 'epic' ? 'Epic Games Store' : $p->name,
                'slug' => $p->slug,
                'color' => $p->color,
                'store_url' => $p->store_url,
                'games' => GameResource::collection(
                    $fallback->filter(fn (Game $g) => $g->prices->contains('platform_id', $p->id))->values()
                )->resolve(),
            ])
            ->values();

        $saleEvents = SaleEvent::with('platform')
            ->orderBy('sort_order')
            ->get()
            ->map(fn (SaleEvent $e) => [
                'title' => $e->title,
                'subtitle' => $e->subtitle,
                'badge' => $e->badge,
                'image' => $e->image,
                'url' => $e->url,
                'platform' => $e->platform?->name,
                'platform_slug' => $e->platform?->slug,
            ])
            ->values();

        return response()->json([
            'sale_events' => $saleEvents,
            'sections' => $sections,
            'featured' => GameResource::collection($fallback)->resolve(),
        ]);
    }
}
