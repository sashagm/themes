<?php

namespace Sashagm\Themes\Services;

use Exception;


class ThemesService 
{

    const THEME_ONE = Themes;

    public function __invoke()
    {
        return $this->get();
    }


    public function get()
    {
        // Ваш код для определения текущей темы
        return self::THEME_ONE;
    }




}
