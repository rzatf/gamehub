<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameDetailResource;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /** Columns the catalogue grid can be ordered by. */
    private const SORTS = ['terbaru', 'terlaris', 'diskon', 'harga', 'harga_tertinggi', 'rating'];

    /**
     * GET /api/games
     * Search + filter + sort + paginate the catalogue.
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->validate([
            'search' => ['nullable', 'string', 'max:120'],
            'slugs' => ['nullable'],
            'genre' => ['nullable'],
            'platform' => ['nullable'],
            'min_price' => ['nullable', 'numeric', 'min:0', 'max:999999999'],
            'max_price' => ['nullable', 'numeric', 'min:0', 'max:999999999'],
            'sort' => ['nullable', 'string', 'in:'.implode(',', self::SORTS)],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:48'],
        ]);

        $genres = $this->csv($request->input('genre'));
        $platforms = $this->csv($request->input('platform'));
        $slugs = $this->csv($request->input('slugs'));
        $sort = $data['sort'] ?? 'terbaru';
        $perPage = (int) ($data['per_page'] ?? 9);
        $search = trim((string) ($data['search'] ?? ''));

        $query = Game::query()
            ->with(['genres', 'prices.platform'])
            ->withMin('prices as min_final_price', 'final_price')
            ->withMax('prices as max_discount', 'discount_percent')
            ->withMax('prices as max_normal_price', 'normal_price');

        if ($search !== '') {
            // Escape LIKE wildcards so user input cannot broaden the match set.
            $escaped = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $search);
            $query->where('title', 'like', '%'.$escaped.'%');
        }

        if ($slugs) {
            // Exact slug lookup, used by the favourites page.
            $query->whereIn('slug', $slugs);
        }

        if ($genres) {
            $query->whereHas('genres', fn ($q) => $q->whereIn('slug', $genres));
        }

        if ($platforms) {
            $query->whereHas('prices.platform', fn ($q) => $q->whereIn('slug', $platforms));
        }

        $min = $data['min_price'] ?? null;
        $max = $data['max_price'] ?? null;
        if ($min !== null || $max !== null) {
            $query->whereHas('prices', function ($q) use ($min, $max) {
                if ($min !== null) {
                    $q->where('final_price', '>=', $min);
                }
                if ($max !== null) {
                    $q->where('final_price', '<=', $max);
                }
            });
        }

        match ($sort) {
            'terlaris' => $query->orderByDesc('rating_count')->orderByDesc('rating'),
            'diskon' => $query->orderByDesc('max_discount')->orderBy('min_final_price'),
            'harga' => $query->orderBy('min_final_price')->orderBy('title'),
            'harga_tertinggi' => $query->orderByDesc('min_final_price')->orderBy('title'),
            'rating' => $query->orderByDesc('rating'),
            default => $query->orderByDesc('release_date')->orderByDesc('id'),
        };

        $games = $query->paginate($perPage)->withQueryString();

        return GameResource::collection($games)->response();
    }

    /**
     * GET /api/games/{slug}
     * Full detail for one game, including every platform offer and the
     * six-month price history used by the chart.
     */
    public function show(string $slug): JsonResponse
    {
        $game = Game::query()
            ->with(['genres', 'prices.platform', 'priceHistories'])
            ->where('slug', $slug)
            ->first();

        if (! $game) {
            return response()->json([
                'message' => 'Game tidak ditemukan',
                'slug' => $slug,
            ], 404);
        }

        return (new GameDetailResource($game))->response();
    }

    /** @return array<int,string> */
    private function csv(mixed $value): array
    {
        if (is_array($value)) {
            $items = $value;
        } else {
            $items = explode(',', (string) $value);
        }

        return collect($items)
            ->map(fn ($v) => trim((string) $v))
            ->filter(fn ($v) => $v !== '' && preg_match('/^[a-z0-9\-]+$/', $v))
            ->unique()
            ->take(20)
            ->values()
            ->all();
    }
}
