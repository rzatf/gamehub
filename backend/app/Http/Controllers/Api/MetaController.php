<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\SaleEvent;
use Illuminate\Http\JsonResponse;

class MetaController extends Controller
{
    /**
     * GET /api/genres
     * Returns filter panel genres (is_filterable) plus every display tag.
     */
    public function genres(): JsonResponse
    {
        $all = Genre::orderBy('sort_order')->get();

        return response()->json([
            'data' => $all->map(fn (Genre $g) => [
                'id' => $g->id,
                'name' => $g->name,
                'slug' => $g->slug,
                'is_filterable' => (bool) $g->is_filterable,
            ])->values(),
        ]);
    }

    /** GET /api/platforms */
    public function platforms(): JsonResponse
    {
        return response()->json([
            'data' => Platform::orderBy('sort_order')->get()->map(fn (Platform $p) => [
                'id' => $p->id,
                'name' => $p->name,
                'slug' => $p->slug,
                'color' => $p->color,
                'store_url' => $p->store_url,
            ])->values(),
        ]);
    }

    /** GET /api/sale-events */
    public function saleEvents(): JsonResponse
    {
        return response()->json([
            'data' => SaleEvent::with('platform')->orderBy('sort_order')->get()->map(fn (SaleEvent $e) => [
                'id' => $e->id,
                'title' => $e->title,
                'subtitle' => $e->subtitle,
                'badge' => $e->badge,
                'image' => $e->image,
                'url' => $e->url,
                'platform' => $e->platform?->name,
            ])->values(),
        ]);
    }
}
