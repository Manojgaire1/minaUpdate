<?php

namespace App\Http\Middleware;

use Closure;
use App;

class ChangeMinaLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session()->has('mina_locale'))
            App::setLocale(session()->get('mina_locale'));
        return $next($request);
    }
}
