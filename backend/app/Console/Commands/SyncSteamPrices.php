<?php

namespace App\Console\Commands;

use App\Models\Game;
use App\Models\Price;
use App\Models\PriceHistory;
use App\Services\SteamStore;
use Illuminate\Console\Command;

class SyncSteamPrices extends Command
{
    protected $signature = 'gamehub:sync-steam {--slug= : Sync a single game by slug} {--dry-run : Show what would change without writing}';

    protected $description = 'Fetch current Steam prices (IDR) for every catalog game that has a Steam app id';

    public function handle(SteamStore $steam): int
    {
        $games = Game::query()
            ->whereNotNull('steam_appid')
            ->when($this->option('slug'), fn ($q, $slug) => $q->where('slug', $slug))
            ->orderBy('id')
            ->get();

        if ($games->isEmpty()) {
            $this->warn('No games with a Steam app id found.');

            return self::SUCCESS;
        }

        $platform = \App\Models\Platform::where('slug', 'steam')->first();
        if (! $platform) {
            $this->error('Steam platform row is missing; run `php artisan db:seed` first.');

            return self::FAILURE;
        }

        $updated = 0;
        $skipped = 0;
        $today = now()->startOfMonth()->toDateString();

        foreach ($games as $game) {
            $details = $steam->appDetails((int) $game->steam_appid);

            if (! $details) {
                $this->line(sprintf('  <fg=yellow>skip</> %s (app id %d): no response', $game->title, $game->steam_appid));
                $skipped++;
                continue;
            }

            $price = $steam->idrPrice($details);
            if (! $price) {
                $this->line(sprintf('  <fg=yellow>skip</> %s: no IDR price (free, delisted or region-locked)', $game->title));
                $skipped++;
                continue;
            }

            $this->line(sprintf(
                '  %s <fg=green>Rp%s -> Rp%s (-%d%%)</>',
                str_pad(mb_substr($game->title, 0, 32), 32),
                number_format($price['normal'], 0, ',', '.'),
                number_format($price['final'], 0, ',', '.'),
                $price['discount'],
            ));

            if ($this->option('dry-run')) {
                $updated++;
                continue;
            }

            Price::updateOrCreate(
                ['game_id' => $game->id, 'platform_id' => $platform->id],
                [
                    'normal_price' => $price['normal'],
                    'final_price' => $price['final'],
                    'discount_percent' => $price['discount'],
                    'currency' => 'IDR',
                    'url' => "https://store.steampowered.com/app/{$game->steam_appid}/",
                    'fetched_at' => now(),
                ]
            );

            PriceHistory::updateOrCreate(
                ['game_id' => $game->id, 'platform_id' => $platform->id, 'recorded_on' => $today],
                [
                    'normal_price' => $price['normal'],
                    'final_price' => $price['final'],
                    'discount_percent' => $price['discount'],
                ]
            );

            $updated++;
        }

        $this->newLine();
        $this->info(sprintf('Steam sync complete: %d updated, %d skipped.', $updated, $skipped));

        return self::SUCCESS;
    }
}
