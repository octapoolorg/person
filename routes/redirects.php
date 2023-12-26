<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Models\Redirect;

$cacheKey = 'redirects';

$redirects = Cache::remember($cacheKey, now()->addHours(24), function () {
    return Redirect::all()->pluck('target', 'source');
});

foreach ($redirects as $source => $target) {
    Route::redirect($source, $target, 301);
}