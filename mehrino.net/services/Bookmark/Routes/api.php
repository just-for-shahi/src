<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region bookmark
  Route::group(['prefix' => 'bookmark'], function () {

    /**
     * @OA\Get(
     *      path="/bookmark",
     *      tags={"Bookmark"},
     *      security={{"bearerAuth":{}}},
     *      summary="Bookmark",
     *      description="index Bookmark",
     *      @OA\Parameter(
     *          name="x-page",
     *          description="page",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              default="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="x-count",
     *          description="count",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              default="15"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="No content"
     *       ),
     *     @OA\Response(
     *          response=200,
     *          description="successful",
     *          @OA\JsonContent(ref="#/components/schemas/ResBookmark"),
     *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
     *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/', 'BookmarkController@index');

      /**
       * @OA\Patch(
       *      path="/bookmark/{service}/{uuid}",
       *      tags={"Bookmark"},
       *      security={{"bearerAuth":{}}},
       *      summary="Bookmark",
       *      description="add and remove bookmark",
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
       *              enum={"project", "wall","voluntary"},
       *              default="project"
       *          )
       *      ),
       *     @OA\Response(
       *          response=201,
       *          description="create new bookmark"
       *     ),
       *     @OA\Response(
       *          response=203,
       *          description="remove bookmark"
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::patch('/{service}/{uuid}', 'BookmarkController@store');

  });
  #endregion
});
