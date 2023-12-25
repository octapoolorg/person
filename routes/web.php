<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Tools\NumerologyController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('names', [NameController::class, 'index'])->name('names.index');
Route::get('/names/random', [NameController::class, 'random'])->name('names.random');
Route::get('names/search', [NameController::class, 'search'])->name('names.search');

Route::get('name/{name}', [NameController::class, 'show'])->name('names.show');
Route::get('names/{gender}',[NameController::class,'gender'])->name('names.gender');
Route::get('names/origin/{origin}',[NameController::class,'origin'])->name('names.origin');
Route::get('names/category/{category}',[NameController::class,'category'])->name('names.category');
Route::get('names/starting/{letter}',[NameController::class,'starting'])->name('names.starting');

Route::get('/static/images/wallpaper/name/funky/{name}.jpg', [NameController::class, 'wallpaper'])->name('names.wallpaper');
Route::get('/static/images/signature/style/{font}/{name}.jpg', [NameController::class, 'signature'])->name('names.signature');

Route::post('/names/{name}/comments', [CommentController::class, 'store'])->name('names.comments.store');

Route::get('tools/numerology/calculator', [NumerologyController::class, 'calculator'])->name('tools.numerology.calculator.get');
Route::post('tools/numerology/calculator', [NumerologyController::class, 'calculate'])->name('tools.numerology.calculate.post');

/* Blog Routes */
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

/* Legal Pages */
Route::get('pages/{page}', [PageController::class, 'show']);

/* Sitemap */
Route::get('/sitemap.xml', function () {
    return redirect('sitemap_index.xml', 301);
});




/* Legacy Routes - Redirects */
Route::get('/static/images/signature/{name}/{font}.jpg', function ($name, $font) {
    return redirect()->route('names.signature', [$font,$name], 301);
});

Route::get('/static/images/name/{name}.jpg', function ($name) {
    return redirect()->route('names.wallpaper', [$name], 301);
});