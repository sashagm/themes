<?php

use Illuminate\Support\Facades\Route;
use Sashagm\Themes\Http\Controllers\ThemesController;



Route::group(['middleware' => ['web'], 'prefix' => config('custom.admin_prefix')], function ()  {
  
    Route::get('/themes', [ThemesController::class, 'index'])->name('themes');

    Route::post('/themes/set/{id}', [ThemesController::class, 'setThemes'])->name('setThemes')
            ->middleware('theme.access');
            
    Route::get('/themes/get', [ThemesController::class, 'getThemes'])->name('getThemes');

    Route::post('/themes/add', [ThemesController::class, 'addThemes'])->name('addThemes')
            ->middleware('theme.access');

    Route::post('/themes/delete/{id}', [ThemesController::class, 'deleteThemes'])->name('deleteThemes');



});




