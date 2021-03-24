<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DefaultLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = \Session::get('locale');
        if($locale && $locale != 'ru') {
            app()->setLocale($locale);
            return redirect(app()->getLocale());
        }
        app()->setLocale('ru');
        return $next($request);
    }
}
