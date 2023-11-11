<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('names', [NameController::class, 'index'])->name('names.index');
Route::get('/names/random', [NameController::class, 'random'])->name('names.random');
Route::get('names/search', [NameController::class, 'search'])->name('names.search');

Route::get('name/{name}', [NameController::class, 'show'])->name('names.show');
Route::get('names/{gender}',[NameController::class,'gender'])->name('names.gender');

Route::get('/static/images/name/{name}.jpg', [NameController::class, 'wallpaper'])->name('names.wallpaper');
Route::get('/static/images/signature/{name}/{font}', [NameController::class, 'signature'])->name('names.signature');

Route::post('/names/{name}/comments', [CommentController::class, 'store'])->name('names.comments.store');


/* Blog Routes */
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');


/* Legal Pages */
Route::get('pages/{page}', [PageController::class, 'show']);


/* Sitemap */
Route::get('sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
