<?php


namespace App\Http\Requests;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRequest
{

    protected static $validate;
    protected static $status;
    protected static $externalRequest;

    public  function __construct(Request $request,array $data=null)
    {
        self::$validate=$request;
        self::$externalRequest=$data;
       self::$status=self::$validate->authorize();

    }
    public static  function getRules(){

        return self::$validate->rules();
    }
    public static  function getStatus(){

        return self::$status;
    }
    public static function validate(Request $request){

        $allRequest=$request->all();
        foreach (self::$externalRequest as $key=>$value){
            $allRequest+= [$key=>$value];
        }
        $validator=Validator::make($allRequest,self::getRules());
        if($validator->fails()){
            return [
                "code"=>false,
                "message"=>$validator->messages()
            ];
        }
        else{
           return [
               "code"=>true,
               "message"=>null
           ];
        }

    }


}