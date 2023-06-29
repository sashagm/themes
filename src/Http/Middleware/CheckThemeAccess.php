<?php

namespace Sashagm\Themes\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckThemeAccess
{
    public function handle($request, Closure $next)
    {
        if (!config('custom.check.active')) {
            return $next($request);
        }

        $user = Auth::user();

        if (!$user) {
            abort(403, 'У вас нет прав на сохранение темы');
        }

        $colum = config('custom.check.save_colum');
        $val = config('custom.check.save_value');

        if ($user->$colum != $val) {
            abort(403, 'У вас нет прав на сохранение темы');
        }

        return $next($request);
    }
}