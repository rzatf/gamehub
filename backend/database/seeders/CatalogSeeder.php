<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\Price;
use App\Models\PriceHistory;
use App\Models\SaleEvent;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $data = require database_path('seeders/data/catalog.php');

        $platforms = [];
        foreach ($data['platforms'] as $p) {
            $platforms[$p['slug']] = Platform::updateOrCreate(['slug' => $p['slug']], [
                'name' => $p['name'],
                'color' => $p['color'],
                'store_url' => $p['store_url'],
                'show_on_home' => (bool) $p['show_on_home'],
                'sort_order' => $p['sort_order'],
            ]);
        }

        $genres = [];
        foreach ($data['genres'] as $g) {
            $genres[$g['slug']] = Genre::updateOrCreate(['slug' => $g['slug']], [
                'name' => $g['name'],
                'is_filterable' => (bool) $g['filterable'],
                'sort_order' => $g['sort_order'],
            ]);
        }

        // Six monthly history points, oldest -> newest (last = current offer).
        $months = [];
        $start = now()->startOfMonth()->subMonths(5);
        for ($i = 0; $i < 6; $i++) {
            $months[] = $start->copy()->addMonths($i)->toDateString();
        }

        foreach ($data['games'] as $g) {
            $game = Game::updateOrCreate(['slug' => $g['slug']], [
                'title' => $g['title'],
                'steam_appid' => $g['appid'],
                'description' => $g['description'],
                'developer' => $g['developer'],
                'publisher' => $g['publisher'],
                'release_date' => $g['release_date'],
                'rating' => $g['rating'],
                'rating_count' => $g['rating_count'],
                'cover_image' => $g['cover_image'],
                'portrait_image' => $g['portrait_image'],
                'hero_image' => $g['hero_image'],
                'wide_image' => $g['wide_image'],
                'screenshots' => $g['screenshots'] ?? [],
                'min_requirements' => $g['min_requirements'],
                'rec_requirements' => $g['rec_requirements'],
                'is_featured' => (bool) $g['is_featured'],
                'sort_order' => $g['sort_order'],
            ]);

            $genreIds = [];
            foreach ($g['genres'] as $slug) {
                if (isset($genres[$slug])) {
                    $genreIds[] = $genres[$slug]->id;
                }
            }
            $game->genres()->sync($genreIds);

            foreach ($g['offers'] as $offer) {
                $normal = (float) $offer['normal'];
                $d = (int) $offer['discount'];
                $final = round($normal * (100 - $d) / 100, 0);
                $platform = $platforms[$offer['platform']];

                Price::updateOrCreate(
                    ['game_id' => $game->id, 'platform_id' => $platform->id],
                    [
                        'normal_price' => $normal,
                        'final_price' => $final,
                        'discount_percent' => $d,
                        'currency' => 'IDR',
                        'url' => $offer['url'],
                        'fetched_at' => now(),
                    ]
                );

                // Historical points: earlier months fluctuate, the newest is the current deal.
                $pattern = [
                    (int) round($d * 0.4), (int) round($d * 0.7), 0,
                    (int) round($d * 0.85), (int) round($d * 0.6), $d,
                ];
                foreach ($months as $i => $date) {
                    $hd = $pattern[$i];
                    PriceHistory::updateOrCreate(
                        ['game_id' => $game->id, 'platform_id' => $platform->id, 'recorded_on' => $date],
                        [
                            'normal_price' => $normal,
                            'final_price' => round($normal * (100 - $hd) / 100, 0),
                            'discount_percent' => $hd,
                        ]
                    );
                }
            }
        }

        foreach ($data['sale_events'] as $e) {
            SaleEvent::updateOrCreate(['title' => $e['title']], [
                'subtitle' => $e['subtitle'],
                'badge' => $e['badge'],
                'image' => $e['image'],
                'platform_id' => $platforms[$e['platform']]->id ?? null,
                'url' => $e['url'],
                'sort_order' => $e['sort_order'],
            ]);
        }

        $this->command?->info(sprintf(
            'Catalog seeded: %d games, %d platforms, %d genres, %d price rows.',
            Game::count(), Platform::count(), Genre::count(), Price::count()
        ));
    }
}
