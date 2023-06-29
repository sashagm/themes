<?php

namespace Sashagm\Themes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory;



    protected $fillable = [
        'title',
        'description',
        'author',
        'version',
        'active',

    ];

    public static function getActiveThemeTitle()
    {
        $theme = self::where('active', 1)
                        ->first();

        return $theme->title ?? null;
    }

    public static function getActiveThemeDescription()
    {
        $theme = self::where('active', 1)
                        ->first();

        return $theme->description ?? null;
    }

    public static function getThemeInfo()
    {
        $theme = self::where('active', 1)
                        ->first();

        return [
            'title' => $theme->title ?? null,
            'description' => $theme->description ?? null,
            'author' => $theme->author ?? null,
            'version' => $theme->version ?? null,
        ];
    }
}
