<?php

use App\Http\Controllers\NameController;
use Illuminate\Support\Facades\Route;

Route::get('/{name}', [NameController::class, 'view'])->name('view');
