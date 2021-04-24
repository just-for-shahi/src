<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly

    #region project
    Route::group(['prefix' => 'project'], function () {
        /**
         * @OA\Get(
         *      path="/project/institute/{uuid}",
         *      tags={"Project"},
         *      summary="get Projects",
         *      description="List from  Projects with Institute id",
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
         *          @OA\JsonContent(type="array",@OA\Items(ref="#/components/schemas/ResProject")),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/institute/{uuid}', 'ProjectController@getProjectsWithInstitute');

        /**
         * @OA\Get(
         *      path="/project/me",
         *      tags={"Project"},
         *      security={{"bearerAuth":{}}},
         *      summary="my Project",
         *      description="my Project",
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
         *          @OA\JsonContent(type="array",@OA\Items(ref="#/components/schemas/ResProject")),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/me', 'ProjectController@myIndex')->middleware('auth:api');

        /**
         * @OA\Get(
         *      path="/project",
         *      tags={"Project"},
         *      summary="Project",
         *      description="index Project",
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
         *          @OA\JsonContent(type="array",@OA\Items(ref="#/components/schemas/ResProject")),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/', 'ProjectController@index');

        /**
         * @OA\Get(
         *      path="/project/search",
         *      tags={"Project"},
         *      summary="Project",
         *      description="index Project",
         *      @OA\Parameter(
         *          name="x-latitude",
         *          description="Latitude",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default=""
         *          )
         *      ),
         *
         *      @OA\Parameter(
         *          name="x-longitude",
         *          description="Longitude",
         *          required=false,
         *          in="header",
         *          @OA\Schema(
         *              type="string",
         *              default=""
         *          )
         *      ),
         *
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
         *
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
         *          @OA\JsonContent(type="array",@OA\Items(ref="#/components/schemas/ResProject")),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/search', 'ProjectController@index');

        /**
         * @OA\Post(
         *      path="/project",
         *      tags={"Project"},
         *      summary="store Project",
         *      security={{"bearerAuth":{}}},
         *      description="store ",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqStoreProject")
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
        Route::post('/', 'ProjectController@store')->middleware('auth:api');

        /**
         * @OA\Get(
         *      path="/project/{uuid}",
         *      tags={"Project"},
         *      summary="show",
         *      security={{"bearerAuth":{}}},
         *      description="show Project",
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
         *          @OA\JsonContent(ref="#/components/schemas/ResShowProject"),
         *     ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/{uuid}', 'ProjectController@show');

        /**
         * @OA\Post(
         *      path="/project/{uuid}",
         *      tags={"Project"},
         *      security={{"bearerAuth":{}}},
         *      summary="update",
         *      description="update Project",
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
         *          required=false,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqUpdateProject")
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
        Route::post('/{uuid}', 'ProjectController@update')->middleware('auth:api');
        /**
         * @OA\Put(
         *      path="/project/{uuid}",
         *      tags={"Project"},
         *      security={{"bearerAuth":{}}},
         *      deprecated=true,
         *      summary="update",
         *      description="update Project",
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
         *          required=false,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqUpdateProject")
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
        Route::put('/{uuid}', 'ProjectController@update')->middleware('auth:api');

        /**
         * @OA\Delete(
         *      path="/project/{uuid}",
         *      tags={"Project"},
         *      security={{"bearerAuth":{}}},
         *      summary="destroy",
         *      description="Delete Project",
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
        Route::delete('/{uuid}', 'ProjectController@destroy')->middleware('auth:api');
    });
    #endregion
});
