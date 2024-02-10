<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Tools\NumerologyController;
use Illuminate\Support\Facades\Route;

Route::post('names/{name}/comments', [CommentController::class, 'store'])->name('names.comments.store');

Route::get('tools/numerology/calculator', [NumerologyController::class, 'calculator'])->name('tools.numerology.calculator.get');
Route::post('tools/numerology/calculator', [NumerologyController::class, 'calculate'])->name('tools.numerology.calculate.post');

/* Blog Routes */
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

/* Legal Pages */
Route::get('pages/{page}', [PageController::class, 'show']);