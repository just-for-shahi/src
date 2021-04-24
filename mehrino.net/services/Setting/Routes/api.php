<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region setting
  Route::group(['prefix' => 'setting', 'middleware' => 'auth:api'], function () {
    /**
     * @OA\Get(
     *      path="/setting",
     *      tags={"Setting"},
     *      security={{"bearerAuth":{}}},
     *      summary="get",
     *      description="get user Setting",

     *     @OA\Response(
     *          response=200,
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/ResSetting")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/', 'SettingController@index');

      /**
       * @OA\Put(
       *      path="/setting",
       *      tags={"Setting"},
       *      security={{"bearerAuth":{}}},
       *      summary="update",
       *      description="update user Setting",
       *      @OA\RequestBody(
       *          required=true,
       *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateSetting")
       *      ),
       *     @OA\Response(
       *          response=200,
       *          description="successful"
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::put('/', 'SettingController@update');

  });
  #endregion
});
