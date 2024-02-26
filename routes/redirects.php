<?php

use Illuminate\Support\Facades\Route;

Route::redirect('names', 'names/search', 301);

//Remove the -1 from the URL
Route::get('/name/{any}-1', function ($any) {
    return redirect("name/$any" , 301);
})->where('any', '.*');

Route::get('static/images/signature/style/monsieur-la-doulaise/{name}.jpg', function ($name) {
    return redirect()->route('names.signature', ['cursive', $name], 301);
});

/* Legacy Routes - Redirects */
Route::get('static/images/signature/{name}/{font}.jpg', function ($name, $font) {
    return redirect()->route('names.signature', [$font, $name], 301);
});

Route::get('/static/images/name/{name}.jpg', function ($name) {
    return redirect()->route('names.wallpaper', [$name], 301);
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
