<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly
    Route::group(['prefix' => 'wall/post'], function () {
        /**
         * @OA\Get(
         *      path="/wall/post",
         *      tags={"WallPost"},
         *      summary="Wall",
         *      security={{"bearerAuth":{}}},
         *      description="index Wall post",
         *      @OA\Parameter(
         *          name="x-search",
         *          description="search",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default=""
         *          )
         *      ),
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
         *      @OA\Parameter(
         *          name="x-lat",
         *          description="latitude",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default="1"
         *          )
         *      ),
         *      @OA\Parameter(
         *          name="x-long",
         *          description="longitude",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default="1"
         *          )
         *      ),
         *      @OA\Response(
         *          response=201,
         *          description="No content"
         *       ),
         *     @OA\Response(
         *          response=200,
         *          description="successful",
         *          @OA\JsonContent(@OA\Items(ref="#/components/schemas/ResWallPost")),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/', 'WallPostController@index');
        /**
         * @OA\Get(
         *      path="/wall/post/me",
         *      tags={"WallPost"},
         *      summary="Wall",
         *      security={{"bearerAuth":{}}},
         *      description="index Wall post me",
         *      @OA\Parameter(
         *          name="x-search",
         *          description="search",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default=""
         *          )
         *      ),
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
         *          @OA\JsonContent(@OA\Items(ref="#/components/schemas/ResWallPost")),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/me', 'WallPostController@indexMe')->middleware('auth:api');
        /**
         * @OA\Get(
         *      path="/wall/post/wall/{uuid}",
         *      tags={"WallPost"},
         *      summary="Wall",
         *      description="index Wall post wall uuid",
         *      @OA\Parameter(
         *          name="x-search",
         *          description="search",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default=""
         *          )
         *      ),
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
         *      @OA\Parameter(
         *          name="x-lat",
         *          description="latitude",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default="1"
         *          )
         *      ),
         *      @OA\Parameter(
         *          name="x-long",
         *          description="longitude",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default="1"
         *          )
         *      ),
         *     @OA\Parameter(
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
         *      @OA\Response(
         *          response=201,
         *          description="No content"
         *       ),
         *     @OA\Response(
         *          response=200,
         *          description="successful",
         *          @OA\JsonContent(@OA\Items(ref="#/components/schemas/ResWallPost")),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/wall/{uuid}', 'WallPostController@indexWall');
        /**
         * @OA\Get(
         *      path="/wall/post/institute/{uuid}",
         *      tags={"WallPost"},
         *      summary="Wall",
         *      description="index Wall post institute uuid",
         *      @OA\Parameter(
         *          name="x-type",
         *          description="type",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default=""
         *          )
         *      ),
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
         *     @OA\Parameter(
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
         *      @OA\Response(
         *          response=201,
         *          description="No content"
         *       ),
         *     @OA\Response(
         *          response=200,
         *          description="successful",
         *          @OA\JsonContent(@OA\Items(ref="#/components/schemas/ResWallPost")),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/institute/{uuid}', 'WallPostController@indexInstitute');
        /**
         * @OA\Post(
         *      path="/wall/post",
         *      tags={"WallPost"},
         *      summary="store Wall",
         *      security={{"bearerAuth":{}}},
         *      description="store ",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqStoreWallPost")
         *          )
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="successful operation"
         *       ),
         *      @OA\Response(response=404, description="Page NotFound;"),
         *      @OA\Response(response=400, description="Bad Request;"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('/', 'WallPostController@store')->middleware('auth:api');
        /**
         * @OA\Get(
         *      path="/wall/post/{uuid}",
         *      tags={"WallPost"},
         *      security={{"bearerAuth":{}}},
         *      summary="show",
         *      description="show Wall",
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
         *     @OA\Response(
         *          response=200,
         *          description="successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResShowWallPost"),
         *     ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/{uuid}', 'WallPostController@show');
        /**
         * @OA\Put(
         *      path="/wall/post/{uuid}",
         *      tags={"WallPost"},
         *      security={{"bearerAuth":{}}},
         *      summary="update",
         *      deprecated=true,
         *      description="update Wall",
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
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateWallPost")
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
        Route::put('/{uuid}', 'WallPostController@update')->middleware('auth:api');
        /**
         * @OA\Post(
         *      path="/wall/post/{uuid}",
         *      tags={"WallPost"},
         *      security={{"bearerAuth":{}}},
         *      summary="update",
         *      description="update Wall",
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
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateWallPost")
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
        Route::post('/{uuid}', 'WallPostController@update')->middleware('auth:api');

        /**
         * @OA\Delete(
         *      path="/wall/post/{uuid}",
         *      tags={"WallPost"},
         *      security={{"bearerAuth":{}}},
         *      summary="destroy",
         *      description="Delete Wall",
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
        Route::delete('/{uuid}', 'WallPostController@destroy')->middleware('auth:api');
    });

    #region wall
    Route::group(['prefix' => 'wall'], function () {

        /**
         * @OA\Get(
         *      path="/wall",
         *      tags={"Wall"},
         *      summary="Wall",
         *      description="index Wall",
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
         *          @OA\JsonContent(ref="#/components/schemas/ResWall"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/', 'WallController@index');
        /**
         * @OA\Get(
         *      path="/wall/me",
         *      tags={"Wall"},
         *      security={{"bearerAuth":{}}},
         *      summary="my Wall",
         *      description="my Wall",
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
         *          @OA\JsonContent(ref="#/components/schemas/ResWall"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/me', 'WallController@myIndex')->middleware('auth:api');

        /**
         * @OA\Post(
         *      path="/wall",
         *      tags={"Wall"},
         *      summary="store Wall",
         *      security={{"bearerAuth":{}}},
         *      description="store ",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqStoreWall")
         *          )
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="successful operation"
         *       ),
         *      @OA\Response(response=404, description="Page NotFound;"),
         *      @OA\Response(response=400, description="Bad Request;"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('/', 'WallController@store')->middleware('auth:api');

        /**
         * @OA\Get(
         *      path="/wall/{uuid}",
         *      tags={"Wall"},
         *      security={{"bearerAuth":{}}},
         *      summary="show",
         *      description="show Wall",
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
         *     @OA\Response(
         *          response=200,
         *          description="successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResShowWall"),
         *     ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/{uuid}', 'WallController@show');

        /**
         * @OA\Put(
         *      path="/wall/{uuid}",
         *      tags={"Wall"},
         *      security={{"bearerAuth":{}}},
         *      deprecated=true,
         *      summary="update",
         *      description="update Wall",
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
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateWall")
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
        Route::put('/{uuid}', 'WallController@update')->middleware('auth:api');
        /**
         * @OA\Post(
         *      path="/wall/{uuid}",
         *      tags={"Wall"},
         *      security={{"bearerAuth":{}}},
         *      summary="update",
         *      description="update Wall",
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
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateWall")
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
        Route::post('/{uuid}', 'WallController@update')->middleware('auth:api');

        /**
         * @OA\Delete(
         *      path="/wall/{uuid}",
         *      tags={"Wall"},
         *      security={{"bearerAuth":{}}},
         *      summary="destroy",
         *      description="Delete Wall",
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
        Route::delete('/{uuid}', 'WallController@destroy')->middleware('auth:api');
    });
    #endregion
});
