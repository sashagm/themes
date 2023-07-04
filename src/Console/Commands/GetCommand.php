<?php

namespace Sashagm\Themes\Console\Commands;

use Illuminate\Console\Command;
use Sashagm\Themes\Models\Themes;

class GetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'themes:get {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Данная команда выведет информацию о тему сайта (агрументом укажите ид).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = (int) $this->argument('id');
        $info= Themes::where('id', $id)->limit(1)->first();
            $res = [
                'id' => $info->id,
                'title' =>  $info->title,
                'desc' => $info->description,
                'author' => $info->author,
                'version' => $info->version,
                'status' => $info->active
            ];
            $this->components->info("Информация о теме: " . json_encode($res) );


    }
}
