<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region location
  Route::group(['prefix' => 'location'], function () {
    /**
     * @OA\Get(
     *      path="/location",
     *      tags={"Location"},
     *      security={{"bearerAuth":{}}},
     *      summary="Location",
     *      description="index Location",
     *     @OA\Response(
     *          response=200,
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/ResLocation")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/', 'LocationController@index');
  });
  #endregion
});
