<?php

namespace  Sashagm\Themes\Traits;

use Sashagm\Themes\Services\ThemesService;

trait BootTrait
{


    public function bootSys()
    {

        $this->app['router']->aliasMiddleware('theme.save', \Sashagm\Themes\Http\Middleware\CheckThemeAccess::class);
        $this->app['router']->aliasMiddleware('theme.access', \Sashagm\Themes\Http\Middleware\CheckThemeViewAccess::class);
        $this->app['router']->aliasMiddleware('theme.delete', \Sashagm\Themes\Http\Middleware\CheckThemeDeleteAccess::class);

        $this->app->singleton('themes', function () {
            return new ThemesService;
        });
    
        $this->app->alias('themes', ThemesService::class);

        $this->loadConfig();

    }

    public function loadConfig()
    {
        require __DIR__.'/../config/themes.php';

    }


}
