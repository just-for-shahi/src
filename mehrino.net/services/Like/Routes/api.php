<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region like
  Route::group(['middleware' => 'auth:api'], function () {
      /**
       * @OA\Patch(
       *      path="/{action}/{service}/{uuid}",
       *      tags={"Like"},
       *      security={{"bearerAuth":{}}},
       *      summary="Like and dislike",
       *      description="update Like",
       *      @OA\Parameter(
       *          name="action",
       *          description="action",
       *          required=true,
       *          in="path",
       *          @OA\Schema(
       *              type="string",
       *              format="enum",
       *              enum={"like","dislike"},
       *              default="like"
       *          )
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
       *              enum={"comment", "project", "institute", "voluntary", "wall"},
       *              default="comment"
       *          )
       *      ),
       *     @OA\Response(
       *          response=201,
       *          description="create new like"
       *     ),
       *     @OA\Response(
       *          response=203,
       *          description="dislike"
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::patch('/like/{service}/{uuid}', 'LikeController@likeUpdate');
      Route::patch('/dislike/{service}/{uuid}', 'LikeController@dislikeUpdate');
  });
  #endregion
});
