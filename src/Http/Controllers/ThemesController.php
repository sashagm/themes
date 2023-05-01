<?php

namespace Sashagm\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Sashagm\Themes\Models\Themes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

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
        $data.= "
        if(!defined('Themes')) {
            define('Themes', '$info->title'); 
        } \r\n";
        
        $new_file=fopen(__DIR__. '/../../../../../../config/themes.php',"w");
        fwrite($new_file, $data);
        fclose($new_file);

        Artisan::call('cache:clear');    
        Artisan::call('config:cache');    
        Artisan::call('view:clear');  
        Artisan::call('route:clear'); 
   
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

    public function addThemes(Request $request)
    {
        self::checkAccess();

        Themes::query()->create([
            'title' => $request->title,
            'description' => $request->desc,
            'author' => $request->author,
            'version' => $request->ver,
            'active'    => 0,
        ]);
        return back()->with('success', " Тема успешно создана! ");

    } 


    public function deleteThemes(Request $request, $id)
    {
        self::checkAccess();
        $s = Themes::where('id', $id)->limit(1)->first();
        if ($s) {
            $theme = Themes::destroy($id);
            return back()->with('success', " Тема успешно удалена! ");
        } else {
            return back()->with('success', "Тему с ид: $id нельзя удалить так как её нет!");

        }

    }

    public function checkAccess() {
        switch(false) {
            case true:
                $user = Auth::user();
                if (!$user){
                    abort(403); // отправляем ошибку 403 Forbidden
                }
                if($user->id === 1) { // проверяем роль пользователя
                    return true;
                } else {
                    abort(403); // отправляем ошибку 403 Forbidden
                }
            case false:
                return true;
        }
    }
    
}
