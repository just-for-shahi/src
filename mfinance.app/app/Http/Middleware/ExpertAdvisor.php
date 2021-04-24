<?php

namespace App\Http\Middleware;

use Closure;

class ExpertAdvisor
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
        $secret = '44@@E#7=S%^tsb-7JDESfP4uJcS@8DPkhFZ2E6gvt!mwcg*f+VFCpbJWQ+G+a_&vr!#HUW%3xUZaFGC$ekE_EECt*uphbj6z6maRk2Sa3aYS3fARv+vGy_CuK2aPuZsysDjC@-uKu7qVSM&Ah#h?@KN-gVU*^fVrr2gR?&wdMP$JRn%fdvNXy$5hgZSBhAy%9HSeMVSNkM@EAJEbDK_XzPYWfDHPJW$&@arZ3AW2AZJCgL#MMyaCV!x$$Pdjqj-D';
        $secret = 'milad';
        if ($request->header('secret') === $secret){
            return $next($request);
        }
        return response()->json(null, 404);
    }
}
