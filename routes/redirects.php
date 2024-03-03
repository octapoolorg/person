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


/**
 * Redirects for pages
 * These are old URLs for pages that have been changed and need to be redirected to the new URLs.
 *
 * For example, the old URL for the "About" page was /about-us and the new URL is /about.
 */


Route::redirect('names', 'names/search', 301);


// redirect all names ending with -1 to the same name without the -1
// like "name/alex-1" to "name/alex"
Route::get('/name/{any}-1', function ($any) {
    return redirect("name/$any" , 301);
})->where('any', '.*');


Route::get('/names/{gender}', function (string $gender) {
    return redirect()->route('names.search', ['gender' => $gender], 301);
})->whereIn('gender', ['masculine', 'feminine', 'unisex']);

Route::get('/category/{category}', function (string $category) {
    return redirect()->route('names.search', ['category' => $category], 301);
})->where('category', '.*');

Route::get('/names/category/{category}', function (string $category) {
    return redirect()->route('names.search', ['category' => $category], 301);
})->where('category', '.*');

Route::get('/origin/{origin}', function (string $origin) {
    return redirect()->route('names.search', ['origin' => $origin], 301);
})->where('origin', '.*');

Route::get('/names/origin/{origin}', function (string $origin) {
    return redirect()->route('names.search', ['origin' => $origin], 301);
})->where('origin', '.*');



/**
 * Redirects for images
 *
 * These are old URLs for images that have been changed and need to be redirected to the new URLs.
 * So images still show up on other websites and search engines.
 *
 */

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