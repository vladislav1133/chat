<?php

namespace App\Http\Middleware;

use Closure;


class VisitorMiddleware
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
        $user = $request->user();

        if ($user->cannot('visit-page')) return redirect('/ban');

        return $next($request);
    }
}
