<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__.'/redirects.php';
require __DIR__.'/name/web.php';
require __DIR__.'/general.php';
