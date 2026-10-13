<?php

namespace Tests\Feature;

use Database\Seeders\CatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
    }

    public function test_catalogue_endpoint_returns_paginated_games(): void
    {
        $response = $this->getJson('/api/games');

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [['id', 'slug', 'title', 'cover_image', 'rating', 'genres', 'normal_price', 'final_price', 'discount_percent', 'best_platform', 'platforms']],
                'links',
                'meta' => ['current_page', 'per_page', 'total', 'last_page'],
            ]);

        $this->assertSame(20, $response->json('meta.total'));
        $this->assertSame(9, $response->json('meta.per_page'));
    }

    public function test_search_matches_game_titles_partially(): void
    {
        $response = $this->getJson('/api/games?search=battlefield');

        $response->assertOk();
        $this->assertSame(1, $response->json('meta.total'));
        $this->assertStringContainsString('Battlefield', $response->json('data.0.title'));
    }

    public function test_search_with_no_match_returns_empty_set(): void
    {
        $response = $this->getJson('/api/games?search=zzzzznotagame');

        $response->assertOk();
        $this->assertSame(0, $response->json('meta.total'));
        $this->assertSame([], $response->json('data'));
    }

    public function test_platform_filter_narrows_the_result_set(): void
    {
        $all = $this->getJson('/api/games?per_page=48')->json('meta.total');
        $gog = $this->getJson('/api/games?per_page=48&platform=gog')->json('meta.total');

        $this->assertSame(20, $all);
        $this->assertSame(11, $gog);
        $this->assertLessThan($all, $gog);
    }

    public function test_genre_filter_is_combinable_with_price_range(): void
    {
        $response = $this->getJson('/api/games?per_page=48&genre=action&max_price=300000');

        $response->assertOk();
        foreach ($response->json('data') as $game) {
            $this->assertContains('action', $game['genre_slugs']);
            $this->assertLessThanOrEqual(300000, $game['final_price']);
        }
    }

    public function test_sort_by_highest_discount_is_descending(): void
    {
        $discounts = collect($this->getJson('/api/games?per_page=48&sort=diskon')->json('data'))
            ->pluck('max_discount_percent');

        $sorted = $discounts->sortDesc()->values();
        $this->assertSame($sorted->all(), $discounts->values()->all());
    }

    public function test_game_detail_includes_platform_offers_and_price_history(): void
    {
        $response = $this->getJson('/api/games/red-dead-redemption-2');

        $response->assertOk()->assertJsonStructure([
            'data' => [
                'title', 'description', 'genres', 'min_requirements', 'rec_requirements',
                'screenshots',
                'prices' => [['name', 'slug', 'normal_price', 'final_price', 'discount_percent', 'is_lowest']],
                'history' => ['months', 'labels', 'dates', 'series', 'min_6_months', 'is_lowest_6_months'],
            ],
        ]);

        // Steam carries the deepest discount for this title.
        $steam = collect($response->json('data.prices'))->firstWhere('slug', 'steam');
        $this->assertSame(75, $steam['discount_percent']);
        $this->assertTrue($steam['is_lowest']);
        $this->assertCount(6, $response->json('data.history.months'));
        $this->assertCount(6, $response->json('data.history.dates'));
        $this->assertNotNull($response->json('data.history.dates.0'));
        $this->assertNotEmpty($response->json('data.screenshots'));
    }

    public function test_detail_requirements_render_the_header_line_without_a_label(): void
    {
        $data = $this->getJson('/api/games/red-dead-redemption-2')->json('data');

        foreach (['min_requirements', 'rec_requirements'] as $key) {
            $this->assertSame('', $data[$key][0]['label']);
            $this->assertSame('Prosesor 64-bit dan OS diperlukan', $data[$key][0]['value']);
        }
    }

    public function test_favourites_lookup_by_slugs_is_exact(): void
    {
        $response = $this->getJson('/api/games?slugs=elden-ring,stardew-valley&per_page=48');

        $response->assertOk();
        $this->assertSame(2, $response->json('meta.total'));
        $this->assertEqualsCanonicalizing(
            ['elden-ring', 'stardew-valley'],
            array_column($response->json('data'), 'slug'),
        );
    }

    public function test_sort_by_highest_price_is_descending(): void
    {
        $prices = collect($this->getJson('/api/games?per_page=48&sort=harga_tertinggi')->json('data'))
            ->pluck('final_price');

        $sorted = $prices->sortDesc()->values();
        $this->assertSame($sorted->all(), $prices->values()->all());
    }

    public function test_unknown_game_returns_json_404(): void
    {
        $this->getJson('/api/games/nope-not-here')
            ->assertStatus(404)
            ->assertJson(['message' => 'Game tidak ditemukan']);
    }

    public function test_invalid_query_parameters_return_json_422(): void
    {
        $this->getJson('/api/games?per_page=500')
            ->assertStatus(422)
            ->assertJsonValidationErrors(['per_page']);
    }

    public function test_home_endpoint_returns_banners_and_store_sections(): void
    {
        $response = $this->getJson('/api/home');

        $response->assertOk()->assertJsonStructure([
            'sale_events' => [['title', 'badge', 'url']],
            'sections' => [['title', 'slug', 'games']],
        ]);

        $this->assertSame(['Steam', 'Epic Games Store'], array_column($response->json('sections'), 'title'));
        $this->assertCount(4, $response->json('sections.0.games'));
    }

    public function test_meta_endpoints_expose_filter_options(): void
    {
        $genres = $this->getJson('/api/genres')->json('data');
        $platforms = $this->getJson('/api/platforms')->json('data');

        $this->assertCount(14, $genres);
        $this->assertSame(8, collect($genres)->where('is_filterable', true)->count());
        $this->assertSame(['steam', 'epic', 'gog'], array_column($platforms, 'slug'));
    }
}
