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
        $user = Auth::user();

        if ($user->hasRole('admin') || $user->hasPermissionTo('visit page'))  return $next($request);

        return redirect('/login');
    }
}
