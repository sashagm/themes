<?php

use Illuminate\Support\Facades\Route;
use Sashagm\Themes\Http\Controllers\ThemesController;

Route::get('/posts', [ThemesController::class, 'index']);
