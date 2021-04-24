<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region visit
  Route::group(['prefix' => 'visit'], function () {
      /**
       * @OA\Put(
       *      path="/visit/{service}/{uuid}",
       *      tags={"Visit"},
       *      security={{"bearerAuth":{}}},
       *      summary="visit",
       *      description="visit",
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
       *              enum={"story","project","wall", "voluntary", "wall", "wall_post"},
       *              default="story"
       *          )
       *      ),
       *     @OA\Response(
       *          response=201,
       *          description="create new like"
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::put('/{service}/{uuid}', 'VisitController@update');
  });
  #endregion
});
