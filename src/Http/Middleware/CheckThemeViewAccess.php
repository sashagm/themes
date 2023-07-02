<?php

namespace Sashagm\Themes\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckThemeViewAccess
{
    public function handle($request, Closure $next)
    {
        if (!config('custom.check.active')) {
            return $next($request);
        }

        $user = Auth::user();
 
    

        if (!$user) {
            abort(403, 'У вас нет прав на просмотр темы');
        }

        $colum = config('custom.check.save_colum');
        $val = config('custom.check.save_value');

        if (!in_array($user->$colum, $val)) {
            abort(403, 'У вас нет прав на просмотр темы');
        }

        return $next($request);
    }
}
