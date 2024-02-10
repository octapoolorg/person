<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\Name\NameController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('names', [NameController::class, 'index'])->name('names.index');
Route::get('names/random', [NameController::class, 'random'])->name('names.random');
Route::get('names/search', [NameController::class, 'search'])->name('names.search');
Route::get('names/favorites', [NameController::class, 'favorites'])->name('names.favorites');

Route::get('name/{name}', [NameController::class, 'show'])->name('names.show');

Route::get('names/{gender}',[NameController::class,'gender'])->name('names.gender');
Route::get('names/origin/{origin}',[NameController::class,'origin'])->name('names.origin');
Route::get('names/category/{category}',[NameController::class,'category'])->name('names.category');

Route::get('names/starting/{letter}',[NameController::class,'starting'])->name('names.starting');
Route::get('names/ending/{letter}',[NameController::class,'ending'])->name('names.ending');

require __DIR__.'/image.php';