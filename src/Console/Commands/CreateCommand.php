<?php

namespace Sashagm\Themes\Console\Commands;

use Illuminate\Console\Command;
use Sashagm\Themes\Models\Themes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Sashagm\Themes\Providers\ThemesServiceProvider;

class CreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'themes:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Данная команда создаст описание новой темы для сайта.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $title = $this->ask('Название');
        $desc = $this->ask('Описание');
        $author = $this->ask('Автор');
        $ver = $this->ask('Версия');

        if ($title && $desc && $author && $ver) {

            Themes::query()->create([
                'title' => $title,
                'description' => $desc,
                'author' => $author,
                'version' => $ver,
                'active'    => 0,
            ]);

            $this->components->info('Тема успешно создана!');
        } else {
            $this->components->error('Все параметры являются обязательными!');
        }
        
    }



}