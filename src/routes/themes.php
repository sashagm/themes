<?php

use Illuminate\Support\Facades\Route;
use Sashagm\Themes\Http\Controllers\ThemesController;

Route::get('/themes', [ThemesController::class, 'index'])->name('themes');

Route::post('/themes/set/{id}', [ThemesController::class, 'setThemes'])->name('setThemes');
