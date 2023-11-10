<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('names', [NameController::class, 'index'])->name('names.index');
Route::get('names/search', [NameController::class, 'search'])->name('names.search');
Route::get('/random-names', [NameController::class, 'getRandomNames'])->name('names.random');

Route::get('name/{name}', [NameController::class, 'show'])->name('names.show');
Route::get('names/{gender}',[NameController::class,'genderNames'])->name('names.gender');

Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/static/images/name/{name}.jpg', [NameController::class, 'nameWallpaper'])->name('nameWallpaper');

Route::get('/signature/{name}/{font}', [NameController::class, 'individualSignature'])->name('individualSignature');
