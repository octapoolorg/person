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

/* Legacy Routes - Redirects */
Route::get('static/images/signature/{name}/{font}.jpg', function ($name, $font) {
    return redirect()->route('names.signature', [$font,$name], 301);
});

Route::get('static/images/name/{name}.jpg', function ($name) {
    return redirect()->route('names.wallpaper', [$name], 301);
});

//redirect sitemap.xml to sitemap_index.xml with url 301
Route::get('sitemap.xml', function () {
    return redirect('sitemap_index.xml', 301);
});