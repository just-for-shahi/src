<?php
# region page
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * @return array
 */
function uuid(): string
{
    return (string)Str::uuid();
}

/**
 * @return array
 */
function page(): array
{
    return [
        "page" => x_page(),
        "count" => x_count(),
    ];
}

/**
 * @return int
 */
function x_page(): int
{
    $rq = app('request');
    return (int)$rq->headers->get("x-page");
}

/**
 * @return int
 */
function x_count()
{
    $rq = app('request');
    return (int)$rq->headers->get("x-count");
}

/**
 * @return int
 */
function x_search()
{
    $rq = app('request');
    return (string)$rq->headers->get("x-search");
}

/**
 * @return int
 */
function x_type()
{
    $rq = app('request');
    return $rq->headers->get("x-type");
}

function x_lat()
{
    $rq = app('request');
    return $rq->headers->get('x-lat');
}

function x_long()
{
    $rq = app('request');
    return $rq->headers->get('x-long');
}

function isActive($key , $class = 'active') {
    if (is_array($key)) {
        return in_array(Route::currentRouteName() , $key , true) ? $class : '';
    }

    return Route::currentRouteName() === $key ? $class : '';
}

#endregion

#region 20X
/**
 * 200 OK
 * Standard response for successful HTTP requests.
 *  The actual response will depend on the request method used.
 * In a GET request, the response will contain an
 *  entity corresponding to the requested resource.
 *  In a POST request, the response will contain an entity describing
 * or containing the result of the action
 */
function OK($data = null, array $headers = [])
{
    return $data ? response()->json($data, 200, $headers) : response("", 200, $headers);
}

/**
 * Created 201
 *  The request has been fulfilled, resulting in the creation of a new resource
 */
function Created201($data = null, array $headers = [])
{
    return $data ? response()->json($data, 201, $headers) : response("", 201, $headers);
}

/**
 * 202 Accepted
 * The request has been accepted for processing,
 *  but the processing has not been completed.
 * The request might
 *  or might not be eventually acted upon,
 * and may be disallowed when processing occurs.
 */
function Accepted202($data = null, array $headers = [])
{
    return $data ? response()->json($data, 202, $headers) : response("", 202, $headers);
}

/**
 * 203 Non-Authoritative Information (since HTTP/1.1)
 * The server is a transforming proxy (e.g. a Web accelerator) that received a 200 OK from its origin,
 *  but is returning a modified version of the origin's response
 */
function Update203($data = null, array $headers = [])
{
    return $data ? response()->json($data, 203, $headers) : response("", 203, $headers);
}

/**
 *  204 NoContent
 * The server successfully processed the request and is not returning any content
 */
function NoContent204($data = null, array $headers = [])
{
    return $data ? response()->json($data, 204, $headers) : response("", 204, $headers);
}

#endregion


#region 40X

/**
 * 400 BadRequest
 * The server cannot or will not process the request due to an apparent client error (e.g., malformed request syntax, size too large, invalid request message framing, or deceptive request routing)
 */
function BadRequest400($data = null, array $headers = [])
{
    return $data ? response()->json($data, 400, $headers) : response("", 400, $headers);
}

/**
 * 401 Unauthorized
 *
 */
function Unauthorized401($data = null, array $headers = [])
{
    return $data ? response()->json($data, 401, $headers) : response("", 401, $headers);
}

/**
 * 403 Forbidden
 *
 */
function Forbidden403($data = null, array $headers = [])
{
    return $data ? response()->json($data, 403, $headers) : response("", 403, $headers);
}

/**
 * 404 NotFound
 *
 */
function NotFound404($data = null, array $headers = [])
{
    return $data ? response()->json($data, 404, $headers) : response("", 404, $headers);
}

/**
 * 405 MethodNotAllowed
 *
 */
function MethodNotAllowed405($data = null, array $headers = [])
{
    return $data ? response()->json($data, 405, $headers) : response("", 405, $headers);
}

/**
 * 406 NotAcceptable
 *
 */
function NotAcceptable406($data = null, array $headers = [])
{
    return $data ? response()->json($data, 406, $headers) : response("", 406, $headers);
}

#endregion

#region 50x

/**
 * 500 Internal Server Error
 *
 */
function InternalServerError500(\Exception $ex, array $headers = [])
{
    notifyException($ex);
    if (env('APP_DEBUG', false)|| true) {
        throw new HttpResponseException(response($ex->getMessage(), 500, $headers));
    }
    throw new HttpResponseException(response("", 500, $headers));
}

/**
 * 503 Service Unavailable
 *
 */
function ServiceUnavailable503($data = null, array $headers = [])
{
    return $data ? response()->json($data, 503, $headers) : response("", 503, $headers);
}

/**
 * Create a new HTTP response exception instance.
 *
 * @param \Symfony\Component\HttpFoundation\Response $response
 * @return void
 */
function httpThrow(\Symfony\Component\HttpFoundation\Response $response = null)
{
    throw new HttpResponseException($response);
}

function boolToInt($bool)
{
    if ($bool === "true" || $bool === true || $bool === 1)
        return 1;
    return 0;
}

/**
 * converted persian and arabic number to english
 * @param var $string
 * @return void
 */
function number2en($string){
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, ''.$string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
    return $englishNumbersOnly;
}
#endregion
