<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Name\NameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('names', [NameController::class, 'index'])->name('names.index');

Route::get('names/search', [NameController::class, 'search'])->name('names.search');
Route::get('names/favorites', [NameController::class, 'favorites'])->name('names.favorites');

Route::get('name/{name}', [NameController::class, 'show'])->name('names.show');

require __DIR__.'/image.php';