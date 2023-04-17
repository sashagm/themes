<?php

namespace Sashagm\Themes\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Sashagm\Themes\Providers\ThemesServiceProvider;

class ThemesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'themes:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда установки пакета тем.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->components->info('Установка пакета...');
        $this->install();
        $this->components->info('Установка завершена!');
        
    }

    protected function install(): void
    {
        Artisan::call('vendor:publish', [
            '--provider' => ThemesServiceProvider::class,
            '--force' => true,
        ]);
        $this->components->info('Сервис провайдер опубликован...');

        Artisan::call('migrate');
        $this->components->info('Миграции выполнены...');

        Artisan::call('storage:link');
        $this->components->info('Storage link создан...');

    }


}