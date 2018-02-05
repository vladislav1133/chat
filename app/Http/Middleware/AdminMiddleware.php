<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class AdminMiddleware
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
        $user = User::all()->count();

        if (!($user == 1)) {

           if(!Auth::user()->hasPermissionTo('Administer roles & permissions')){

               abort(401);
           }
        }
        return $next($request);
    }
}
