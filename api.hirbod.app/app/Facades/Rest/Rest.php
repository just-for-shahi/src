<?php


namespace App\Facades\Rest;


use App\Enums\ResponseCode;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class Rest
{
    public static $SARA = 'https://s.hirbod.ac/';

    /**
     * @param $code
     * @param $message
     * @param $data
     * @param $status
     * @param null $links
     * @return JsonResponse
     */
    public static function response($code, $message, $data, $status , $links = null): ?JsonResponse
    {
        if ($links === null) {

            return response()->json([
                'meta' => [
                    'status' => $code,
                    'message' => $message
                ],
                'data' => $data
            ], $status);

        }
        return response()->json([
            'meta' => [
                'status' => $code,
                'message' => $message
            ],
            'links' => [
                'current_page' => $links['current_page'],
                'first_page_url' => $links['first_page_url'],
                'from' => $links['from'],
                'last_page' => $links['last_page'],
                'last_page_url' => $links['last_page_url'],
                'next_page_url' => $links['next_page_url'],
                'path' => $links['path'],
                'per_page' => $links['per_page'],
                'prev_page_url' => $links['prev_page_url'],
                'to' => $links['to'],
                'total' => $links['total'],
            ],
            'data' => $data
        ] , $status);
    }

    /**
     * @param $msg
     * @param $data
     * @return JsonResponse
     */
    public static function success($msg, $data , $links = null){
        return self::response(ResponseCode::Success, $msg, $data, ResponseCode::Success , $links);
    }

    /**
     * @param $exception
     * @return JsonResponse
     */
    public static function error($exception){
        Bugsnag::notifyException($exception);
        if(env('APP_DEBUG')) {
            return self::response(ResponseCode::Error, $exception->getMessage(), null, ResponseCode::Error);
        }else{
            return self::response(ResponseCode::Error, 'INTERNAL_ERROR', null, ResponseCode::Error);
        }
    }

    /**
     * @param string $msg
     * @param null $data
     * @return JsonResponse
     */
    public static function badRequest($msg='BAD_REQUEST', $data=null){
        return self::response(ResponseCode::Bad, $msg, $data, ResponseCode::Bad);
    }

    /**
     * @return JsonResponse
     */
    public static function unAuthentication(){
        return self::response(ResponseCode::Unauthorized, 'UnAuthentication', null, ResponseCode::Unauthorized);
    }

    /**
     * @param string $msg
     * @param null $data
     * @return JsonResponse
     */
    public static function notFound($msg='NOT_FOUND', $data=null){
        return self::response(ResponseCode::NotFound, $msg, $data, ResponseCode::NotFound);
    }

    /**
     * @param $path
     * @return string|null
     */
    public static function tempUrl($path){
        try{
            if ($path === null){
                return null;
            }
            return Storage::url($path);
        }catch (\Exception $e){
            return null;
        }
    }

}