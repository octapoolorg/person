<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('name/{name}', [NameController::class, 'view'])->name('name.view');

Route::get('/static/images/name/{name}.jpg', [NameController::class, 'nameWallpaper'])->name('nameWallpaper');

Route::get('/signature/{name}/{font}', [NameController::class, 'individualSignature'])->name('individualSignature');

Route::get('/random-names', [NameController::class, 'getRandomNames'])->name('getRandomNames');
