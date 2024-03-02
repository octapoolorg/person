<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Tools\NumerologyController;
use Illuminate\Support\Facades\Route;

Route::post('names/{name}/stories', [CommentController::class, 'store'])->name('names.stories');

Route::match(['get','post'], 'tools/numerology/calculator', [NumerologyController::class, 'calculator'])->name('tools.numerology.calculator');

/* Blog Routes */
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

/* Legal Pages */
Route::get('pages/{page}', [PageController::class, 'show']);
