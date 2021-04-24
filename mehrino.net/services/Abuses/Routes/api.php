<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region abuses
  Route::group(['prefix' => 'abuses','middleware' => 'auth:api'], function () {


      /**
       * @OA\Post(
       *      path="/abuses/{service}/{uuid}",
       *      tags={"Abuses"},
       *      summary="send Abuses",
       *      security={{"bearerAuth":{}}},
       *      description="store ",
       *      @OA\RequestBody(
       *          required=true,
       *          @OA\JsonContent(ref="#/components/schemas/ReqStoreAbuses")
       *      ),
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
       *              enum={"project", "voluntary", "wall"},
       *              default="project"
       *          )
       *      ),
       *      @OA\Response(
       *          response=201,
       *          description="successful operation"
       *       ),
       *      @OA\Response(response=404, description="Page NotFound;"),
       *      @OA\Response(response=400, description="Bad Request;"),
       *      @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::post('/{service}/{uuid}', 'AbusesController@store');

  });
  #endregion
});
