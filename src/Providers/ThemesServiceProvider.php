<?php

namespace Sashagm\Themes\Providers;

use Sashagm\Themes\Models\Themes;
use Illuminate\Support\ServiceProvider;
use Sashagm\Themes\Console\Commands\ThemesCommand;

class ThemesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/themes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'themes');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/themes'),
        ]);
        $this->publishes([
            __DIR__.'/../config/themes.php' => config_path('themes.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ThemesCommand::class,
            ]);
        }

        $themes = Themes::where('active', 1)
            ->limit(1)
            ->get();

        if ($themes) {
            $theme  = $themes[0]->title;
        }   else {
            $theme  = config('themes.default');
        }
   
       
            
            
    }
}
