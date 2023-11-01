<?php

use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Route;


Route::get('/{name}', [NameController::class, 'view'])->name('view');

Route::get('/static/images/name/{name}.jpg', [NameController::class, 'nameWallpaper'])->name('nameWallpaper');

Route::get('/signature/{name}/{font}', [NameController::class, 'individualSignature'])->name('individualSignature');

Route::get('/random-names', [NameController::class, 'getRandomNames'])->name('getRandomNames');
