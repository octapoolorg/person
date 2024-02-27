<?php

use Illuminate\Support\Facades\Route;

/**
 * Legacy redirects - these are old URLs that have been changed and need to be redirected to the new URLs.
 * The old URLs are still being used by search engines and other websites.
 *
 * SEO best practices: 301 redirect old URLs to new URLs.
 * This will help search engines understand that the old URLs have been replaced by new URLs.
 *
 * @see https://en.wikipedia.org/wiki/HTTP_301
 *
 */

Route::redirect('names', 'names/search', 301);

Route::get('/name/{any}-1', function ($any) {
    return redirect("name/$any" , 301);
})->where('any', '.*');


$signatures = [
    'monsieur-la-doulaise' => 'cursive',
    'allison-tessa' => 'casual',
];

Route::get('static/images/signature/style/{stlye}/{name}.jpg', function ($style, $name) use ($signatures) {
    $style = $signatures[$style] ?? 'cursive';
    return redirect()->route('names.signature', [$style, $name], 301);
});

Route::get('static/images/signature/{name}/{font}.jpg', function ($name, $font) {
    return redirect()->route('names.signature', [$font, $name], 301);
});

Route::get('/static/images/name/{name}.jpg', function ($name) {
    return redirect()->route('names.wallpaper', ['funky', $name], 301);
});

Route::get('/names/{gender}', function (string $gender) {
    return redirect()->route('names.search', ['gender' => $gender], 301);
})->whereIn('gender', ['masculine', 'feminine', 'unisex']);


Route::get('/category/{category}', function (string $category) {
    return redirect()->route('names.search', ['category' => $category], 301);
})->where('category', '.*');

Route::get('sitemap.xml', function () {
    return redirect('sitemap_index.xml', 301);
});
