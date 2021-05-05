<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtokol
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
        \Artisan::call('optimize:clear');
        if (!$request->secure() && \App::environment() === 'production') {
            return redirect()->secure($request->getRequestUri())->setStatusCode(301);
        }

        if (substr($request->header('host'), 0, 4) == 'www.') {
            $request->headers->set('host', 'dinasyeva.beget.tech');
            return redirect($request->path())->setStatusCode(301);
        }

        return $next($request); 
    }
}
