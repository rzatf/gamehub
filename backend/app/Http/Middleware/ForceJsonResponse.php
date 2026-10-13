<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Force the JSON representation for API traffic so validation failures and
 * unhandled errors come back as JSON 4xx/5xx instead of redirects or HTML.
 * Stamp a request id on every response for easier debugging.
 */
class ForceJsonResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->headers->set('Accept', 'application/json');

        $response = $next($request);
        $response->headers->set('X-Request-Id', $request->header('X-Request-Id') ?: bin2hex(random_bytes(8)));

        return $response;
    }
}
