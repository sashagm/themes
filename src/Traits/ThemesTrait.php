<?php

namespace  Sashagm\Themes\Traits;


use Exception;
use Illuminate\Http\Request;
use Sashagm\Themes\Models\Themes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Sashagm\Themes\Http\Requests\ThemesRequest;

trait ThemesTrait
{

    private function save($id)
    {
        $info = Themes::findOrFail($id);

        if (!$info) {
            throw new Exception('Тема не найдена');
        }

        DB::beginTransaction();

        try {
            DB::table('themes')
                ->update(['active' => 0]);
            DB::table('themes')
                ->where('id', $id)
                ->update(['active' => 1]);
                
            $this->build($info);
           
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new Exception('Не удалось сохранить тему');
        }
    }

    private function clear()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
    }



    private function getCurrent()
    {
        $info = Themes::where('title', Themes)
            ->get();

        if (!$info) {
            throw new Exception('Тема не найдена');
        }

        $res = [
            'id' => $info[0]->id,
            'title' =>  $info[0]->title,
            'desc' => $info[0]->description,
            'author' => $info[0]->author,
            'version' => $info[0]->version,
            'status' => $info[0]->active
        ];
        return $res;
    }



    private function create(ThemesRequest $request)
    {

        Themes::query()
                ->create([
                    'title' => $request->title,
                    'description' => $request->desc,
                    'author' => $request->author,
                    'version' => $request->ver,
                    'active'    => 0,
                ]);
    }


    private function build($info)
    {
        $data = "<?php\r\n";
        $data .= "
        if(!defined('Themes')) {
            define('Themes', '$info->title'); 
        } \r\n";

        $new_file = fopen(__DIR__ . '/../../../../../config/themes.php', "w");
        fwrite($new_file, $data);
        fclose($new_file);

    }


}
