<?php

use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MetaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Game Hub API
|--------------------------------------------------------------------------
| The Next.js frontend never talks to Steam/Epic directly: every price shown
| in the UI is served from this API, backed by the local catalogue database.
*/

Route::get('/home', HomeController::class)->name('api.home');

Route::get('/games', [GameController::class, 'index'])->name('api.games.index');
Route::get('/games/{slug}', [GameController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+')
    ->name('api.games.show');

Route::get('/genres', [MetaController::class, 'genres'])->name('api.genres');
Route::get('/platforms', [MetaController::class, 'platforms'])->name('api.platforms');
Route::get('/sale-events', [MetaController::class, 'saleEvents'])->name('api.sale-events');
