<?php

namespace Sashagm\Themes\Console\Commands;

use Illuminate\Console\Command;
use Sashagm\Themes\Models\Themes;

class DeleteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'themes:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Данная команда удалит тему сайта (агрументом укажите ид).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->argument('id') == 1) {
            $this->components->error("Тестовую тему 'Bootstrap' нельзя удалить так...");
            die();
        } else {
            $id = (int) $this->argument('id');
            $s = Themes::where('id', $id)->limit(1)->first();
            if ($s) {
                $theme = Themes::destroy($this->argument('id'));
                $this->components->info("Тема $s->title успешно удалена!");
            } else {
                $this->components->error("Тему с ид: $id нельзя удалить так как её нет!");
            }
        }
    }
}
