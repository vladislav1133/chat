<?php

namespace App\Http\Middleware;

use Closure;

class WriterMiddleware
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

        if ($user->cannot('write-message')) return response()->json([
            'message' => 'Your account was muted',
            'errors' => [
                'message' => [
                    'You are muted for violating rules'
                ]
            ]

        ],422);

        return $next($request);
    }
}
