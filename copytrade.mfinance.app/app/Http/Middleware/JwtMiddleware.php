<?php

    namespace App\Http\Middleware;

    use Closure;
    use JWTAuth;
    use Exception;
    use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
    use Tymon\JWTAuth\Exceptions\TokenExpiredException;
    use Tymon\JWTAuth\Exceptions\TokenInvalidException;
    use Tymon\JWTAuth\Exceptions\JWTException;

    class JwtMiddleware extends BaseMiddleware
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
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (TokenExpiredException $e) {
                return response()->json(['success' => false, 'error' => 'token expired'], 401);
            } catch (TokenInvalidException $e) {
                return response()->json(['success' => false, 'error' => 'token_invalid'], 401);
            } catch (JWTException $e) {
                return response()->json(['success' => false, 'error' => 'token_absent'], 401);
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => 'Authorization Token not found'], 401);
            }
            return $next($request);
        }
    }
