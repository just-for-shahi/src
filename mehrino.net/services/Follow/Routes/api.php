<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #regionfollow
  Route::group(['prefix' => 'follow'], function () {

      /**
       * @OA\Patch(
       *      path="/follow/{service}/{uuid}",
       *      tags={"Follow"},
       *      security={{"bearerAuth":{}}},
       *      summary="Follow",
       *      description="add and removefollow",
       *      @OA\Parameter(
       *          name="uuid",
       *          description="uuid",
       *          required=true,
       *          in="path",
       *          @OA\Schema(
       *              type="string",
       *              format="uuid",
       *              default="099ab02d-ab5a-43f7-8eb3-b9aa2484cf1e"
       *          )
       *      ),
       *   @OA\Parameter(
       *          name="service",
       *          description="service",
       *          required=true,
       *          in="path",
       *          @OA\Schema(
       *              type="string",
       *              format="enum",
       *              enum={"institute", "user"},
       *              default="institute"
       *          )
       *      ),
       *     @OA\Response(
       *          response=201,
       *          description="create newfollow"
       *     ),
       *     @OA\Response(
       *          response=203,
       *          description="removefollow"
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::patch('/{service}/{uuid}', 'FollowController@store')->middleware('auth:api');

  });
  #endregion
});
