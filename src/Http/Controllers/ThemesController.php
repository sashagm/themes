<?php

namespace Sashagm\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Sashagm\Themes\Models\Themes;
use Illuminate\Support\Facades\DB;

class ThemesController extends Controller
{
    public function index()
    {
        /* Только в целях быстрого запуска


        Themes::create([
            'title' => 'Test',
            'description' => 'testing',
            'author' => 'Admin',
            'version' => "1.0.0",
            'active' => 0,
        ]);

        */

        $posts = Themes::all();
        return view('themes::index', [
            'posts' => $posts,
        ]);
    }


    public function setThemes(Request $request, int $id)
    {


        $out = DB::update('update themes set active = 0 where id > ?', [0]);

        $res = DB::update('update themes set active = 1 where id = ?', [$id]);

        return redirect()
        ->back()
        ->with('status', "Тема успешно установлена!");

    }


    
}
