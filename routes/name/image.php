<?php

use App\Http\Controllers\Name\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('static/images/wallpaper/style/{style}/{name}.jpg', [ImageController::class, 'wallpaper'])->name('names.wallpaper');
Route::get('static/images/signature/style/{style}/{name}.jpg', [ImageController::class, 'signature'])->name('names.signature');
