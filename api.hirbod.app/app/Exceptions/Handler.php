<?php

namespace App\Exceptions;

use App\Facades\Rest\Rest;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        Bugsnag::notifyException($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Exception $e
     * @return JsonResponse
     */
    public function render($request, Exception $e)
    {
        switch ($e){
            case Exception::class:
            default:
                return Rest::error($e);
            case NotFoundHttpException::class:
                return Rest::notFound();
                break;
            case UnauthorizedException::class:
            case AuthenticationException::class:
                return Rest::unAuthentication();
                break;
        }
    }
}
