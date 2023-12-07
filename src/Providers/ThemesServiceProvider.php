<?php

namespace Sashagm\Themes\Providers;

use Sashagm\Themes\Traits\BootTrait;
use Illuminate\Support\ServiceProvider;
use Sashagm\Themes\Console\Commands\GetCommand;
use Sashagm\Themes\Console\Commands\CreateCommand;
use Sashagm\Themes\Console\Commands\DeleteCommand;
use Sashagm\Themes\Console\Commands\ThemesCommand;

class ThemesServiceProvider extends ServiceProvider
{

    use BootTrait;


    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {

        $this->publishFiles();

        $this->registerRouter();

        $this->registerView();

        $this->registerMigrate();

        $this->bootSys();

        $this->registerCommands();

        $this->publishSeeds();
    }


    protected function registerRouter()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/themes.php');
    }


    protected function registerMigrate()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function registerView()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'themes');
    }


    protected function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/themes'),
        ]);

        $this->publishes([
            __DIR__ . '/../config/themes.php' => config_path('themes.php'),
            __DIR__ . '/../config/custom.php' => config_path('custom.php'),
        ]);
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ThemesCommand::class,
                CreateCommand::class,
                DeleteCommand::class,
                GetCommand::class,
            ]);
        } else {
            $this->commands([
                ThemesCommand::class,
                CreateCommand::class,
                DeleteCommand::class,
                GetCommand::class,
            ]);
        }
    }

    protected function publishSeeds()
    {
        $this->publishes([
            __DIR__ . '/../database/seeds/ThemesSeeder.php' => database_path('seeders/ThemesSeeder.php'),
        ], 'themes-seeds');
    }
}
