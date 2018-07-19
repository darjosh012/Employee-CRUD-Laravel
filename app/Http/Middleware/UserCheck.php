<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixedco
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()) {
            return new Response(view('pages.unauthorized'));
        }
        return $next($request);
    }
}
