<?php

use App\Models\Redirect;
use Illuminate\Support\Facades\Route;

// $cacheKey = 'redirects';

// $redirects = cache_remember($cacheKey, function () {
//     return Redirect::all()->pluck('target', 'source');
// });

// foreach ($redirects as $source => $target) {
//     Route::redirect($source, $target, 301);
// }


Route::redirect('names', 'names/search', 301);

// Route::get('/{any}-1', function ($any, \Illuminate\Http\Request $request) {
//     // Remove the -1 and preserve query parameters
//     return redirect("/$any" .'?'. $request->getQueryString(), 301);
// })->where('any', '.*');

Route::get('static/images/signature/style/monsieur-la-doulaise/{name}.jpg', function ($name) {
    return redirect()->route('names.signature', ['cursive', $name], 301);
});

/* Legacy Routes - Redirects */
Route::get('static/images/signature/{name}/{font}.jpg', function ($name, $font) {
    return redirect()->route('names.signature', [$font, $name], 301);
});

Route::get('static/images/name/{name}.jpg', function ($name) {
    return redirect()->route('names.wallpaper', [$name], 301);
});

Route::get('/names/{gender}', function (string $gender) {
    return redirect()->route('names.search', ['gender' => $gender], 301);
})->whereIn('gender', ['masculine', 'feminine', 'unisex']);

Route::get('sitemap.xml', function () {
    return redirect('sitemap_index.xml', 301);
});
