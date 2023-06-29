<?php

namespace Sashagm\Themes\Providers;

use Sashagm\Themes\Models\Themes;
use Illuminate\Support\ServiceProvider;
use Sashagm\Themes\Seeders\ThemesSeeder;
use Sashagm\Themes\Console\Commands\CreateCommand;
use Sashagm\Themes\Console\Commands\DeleteCommand;
use Sashagm\Themes\Console\Commands\GetCommand;
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

        $this->app['router']->aliasMiddleware('theme.save', \Sashagm\Themes\Http\Middleware\CheckThemeAccess::class);
        $this->app['router']->aliasMiddleware('theme.access', \Sashagm\Themes\Http\Middleware\CheckThemeViewAccess::class);
        $this->app['router']->aliasMiddleware('theme.delete', \Sashagm\Themes\Http\Middleware\CheckThemeDeleteAccess::class);
        

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/themes'),
        ]);
        $this->publishes([
            __DIR__.'/../config/themes.php' => config_path('themes.php'),
            __DIR__.'/../config/custom.php' => config_path('custom.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ThemesCommand::class,
                CreateCommand::class,
                DeleteCommand::class,
                GetCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../database/seeds/ThemesSeeder.php' => database_path('seeders/ThemesSeeder.php'),
        ], 'themes-seeds');
        
        require __DIR__.'/../../../../../config/themes.php';
       
            
            
    }
}
