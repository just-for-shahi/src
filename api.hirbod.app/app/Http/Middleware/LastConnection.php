<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LastConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=auth()->user();
        if(!is_null($user)){
            $user->update(['last_connection'=>now()]);
        }

        return $next($request);
    }
}
