<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Thin client for the public Steam Store API.
 *
 * The Game Hub frontend never calls Steam directly: this service is the only
 * place that talks to the store, and Laravel caches the result in the local
 * catalogue database (the "Backend-Mediated API" architecture in the PRD).
 */
class SteamStore
{
    private const DETAILS_URL = 'https://store.steampowered.com/api/appdetails';

    public function __construct(private readonly int $timeout = 20)
    {
    }

    /** @return array<string,mixed>|null Raw Steam appdetails payload. */
    public function appDetails(int $appid, string $cc = 'id', string $lang = 'indonesian'): ?array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->retry(2, 600, throw: false)
                ->get(self::DETAILS_URL, [
                    'appids' => $appid,
                    'cc' => $cc,
                    'l' => $lang,
                ]);

            if (! $response->ok()) {
                return null;
            }

            $node = $response->json((string) $appid);

            return is_array($node) && ($node['success'] ?? false) ? ($node['data'] ?? null) : null;
        } catch (\Throwable $e) {
            Log::warning('Steam appdetails request failed', ['appid' => $appid, 'error' => $e->getMessage()]);

            return null;
        }
    }

    /**
     * Extract an IDR price block (values are returned in cents by Steam).
     *
     * @return array{normal:int,final:int,discount:int,currency:string}|null
     */
    public function idrPrice(array $details): ?array
    {
        $price = $details['price_overview'] ?? null;
        if (! is_array($price) || ($price['currency'] ?? null) !== 'IDR') {
            return null;
        }

        return [
            'normal' => (int) round(($price['initial'] ?? 0) / 100),
            'final' => (int) round(($price['final'] ?? 0) / 100),
            'discount' => (int) ($price['discount_percent'] ?? 0),
            'currency' => 'IDR',
        ];
    }
}
