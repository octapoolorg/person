<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('names', [NameController::class, 'index'])->name('names.index');
Route::get('name/{name}', [NameController::class, 'view'])->name('names.show');
Route::get('names/search/', [NameController::class, 'search'])->name('names.search');


Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/static/images/name/{name}.jpg', [NameController::class, 'nameWallpaper'])->name('nameWallpaper');

Route::get('/signature/{name}/{font}', [NameController::class, 'individualSignature'])->name('individualSignature');

Route::get('/random-names', [NameController::class, 'getRandomNames'])->name('getRandomNames');
