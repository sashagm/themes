<?php

namespace Sashagm\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Sashagm\Themes\Models\Themes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Sashagm\Themes\Traits\ThemesTrait;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ThemesController extends Controller
{
    use ThemesTrait;

    public function index()
    {
        $posts = Themes::all();
        return view('themes::index', [
            'posts' => $posts,
        ]);
    }


    public function setThemes(Request $request, int $id)
    {
        $this->save($id);

        $this->clear();
   
        return redirect()
                ->back()
                ->with('status', "Тема успешно установлена!");

    }


    public function getThemes()
    {
        $res = $this->getCurrent();
        return json_encode($res);
        
    }

    public function addThemes(Request $request)
    {
        $this->create($request);
        
        return back()
                ->with('success', " Тема успешно создана! ");

    } 


    public function deleteThemes(Request $request, $id)
    {

        if ($id == 1) {
            return back()
                    ->with('errors', "Тему с ид: $id нельзя удалить так как она резервная и системная!");
        }

        try {
            $theme = Themes::findOrFail($id);
            $theme->delete();
            
            return back()
                    ->with('success', " Тема успешно удалена! ");

        } catch (ModelNotFoundException $e) {
            return back()
                    ->with('errors', "Тему с ид: $id нельзя удалить так как её нет!");
        }

    } 
    


    
}
