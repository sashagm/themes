<?php

namespace Sashagm\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Sashagm\Themes\Models\Themes;
use Illuminate\Support\Facades\DB;

class ThemesController extends Controller
{
    public function index()
    {

        $posts = Themes::all();
        return view('themes::index', [
            'posts' => $posts,
        ]);
    }


    public function setThemes(Request $request, int $id)
    {

        $info = Themes::findOrFail($id);

        $out = DB::update('update themes set active = 0 where id > ?', [0]);

        $res = DB::update('update themes set active = 1 where id = ?', [$id]);

        $data = "<?php\r\n";
        $data.= "define('Themes', '$info->title');\r\n";

        $new_file=fopen(__DIR__. '/../../../../../../config/themes.php',"w");
        fwrite($new_file, $data);
        fclose($new_file);
   
        return redirect()
        ->back()
        ->with('status', "Тема успешно установлена!");

    }


    public function getThemes()
    {
        $info = Themes::where('title', Themes)
        ->get();

        $res = [
            'id' => $info[0]->id,
            'title' =>  $info[0]->title,
            'desc' => $info[0]->description,
            'author' => $info[0]->author,
            'version' => $info[0]->version,
            'status' => $info[0]->active
        ];
        return json_encode($res);

        
    }

    
}
