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
     * @return JsonResponse
     */
    public static function response($code, $message, $data, $status){
        return response()->json([
            'meta' => [
                'status' => $code,
                'message' => $message
            ],
            'data' => $data
        ], $status);
    }

    /**
     * @param $msg
     * @param $data
     * @return JsonResponse
     */
    public static function success($msg, $data){
        return self::response(ResponseCode::Success, $msg, $data, ResponseCode::Success);
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
