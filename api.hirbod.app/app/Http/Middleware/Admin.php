<?php

namespace App\Http\Middleware;

use App\Enums\User\UserRole;
use App\Facades\Rest\Rest;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Closure;
use Illuminate\Http\Request;

class Admin
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
        try{
            $role = auth()->user()->role;
            if ($role != null || $role === UserRole::SuperAdmin || $role === UserRole::Admin){
                return $next($request);
            }
        }catch (\Exception $e){
            Bugsnag::notifyException($e);
        }
        return Rest::badRequest();
    }
}
