<?php

use App\Http\Controllers\Api\NameController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'throttle:api'], function () {
    Route::post('names/generate/abbreviations/', [NameController::class, 'generateAbbreviations'])
        ->name('api.names.generate.abbreviations');

    Route::post('names/generate/fancy-texts/', [NameController::class, 'generateFancyTexts'])
        ->name('api.names.generate.fancy-texts');

    Route::post('names/generate/usernames/', [NameController::class, 'generateUsernames'])
        ->name('api.names.generate.usernames');

    Route::post('favorite', [NameController::class, 'toggleFavorite'])
        ->name('api.names.favorite');
});
