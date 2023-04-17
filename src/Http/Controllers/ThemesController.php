<?php

namespace Sashagm\Themes\Http\Controllers;

use Illuminate\Http\Request;
use Sashagm\Themes\Models\Themes;

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





    
}
