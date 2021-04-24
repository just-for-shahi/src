<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Milad
{
    public function handle(Request $request, Closure $next){
        if (auth()->user()->role === 6){
            return $next($request);
        }
        return redirect()->route('dashboard');
    }
}
