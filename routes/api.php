<?php

use App\Http\Controllers\NameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/names/generate/acronyms/",[NameController::class,'generateAcronyms'])
    ->middleware('throttle:api')
    ->name('api.names.generate.acronyms');

Route::post("/names/generate/usernames/",[NameController::class,'generateUsernames'])
    ->middleware('throttle:api')
    ->name('api.names.generate.usernames');

Route::post("/names/generate/fancy-texts/",[NameController::class,'generateFancyTexts'])
    ->middleware('throttle:api')
    ->name('api.names.generate.fancy-texts');
