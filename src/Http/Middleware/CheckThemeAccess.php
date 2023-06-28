<?php

namespace Sashagm\Themes\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckThemeAccess
{
    public function handle($request, Closure $next)
    {

        if (config('custom.check.active'))
        {
            $user = Auth::user();
            $colum = config('custom.check.save_colum');
            $val = config('custom.check.save_value');
    
            if (!$user || $user->$colum != $val) {
                abort(403, 'У вас нет прав на сохранение темы');
            }

        }

        return $next($request);
    }
}
