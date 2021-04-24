<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly
    #region chat
    Route::group(['prefix' => 'chat'], function () {


        /**
         * @OA\Get(
         *      path="/chat/list/{uuid}",
         *      tags={"Chat"},
         *      security={{"bearerAuth":{}}},
         *      summary="Chat",
         *      description="index Chat",
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
         *          @OA\JsonContent(ref="#/components/schemas/ResChat"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/list/{uuid}', 'ChatController@listChat');

        /**
         * @OA\Post(
         *      path="/chat/save/{uuid}",
         *      tags={"Chat"},
         *      security={{"bearerAuth":{}}},
         *      summary="store Chat",
         *      description="store ",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqStoreChat")
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
         *          response=200,
         *          description="successful operation"
         *       ),
         *      @OA\Response(response=404, description="Page NotFound;"),
         *      @OA\Response(response=400, description="Bad Request;"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('/save/{uuid}', 'ChatController@storeChat');

        /**
         * @OA\Post(
         *      path="/chat/init",
         *      tags={"Chat"},
         *      summary="Init Chat",
         *      security={{"bearerAuth":{}}},
         *      description="init Chat",
         *      @OA\Response(
         *          response=200,
         *          description="successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ResInitChat")
         *       ),
         *      @OA\Response(response=404, description="Page NotFound;"),
         *      @OA\Response(response=400, description="Bad Request;"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('/init', 'ChatController@getToken')->middleware('auth:api');

        /**
         * @OA\Get(
         *      path="/chat/me",
         *      tags={"Chat"},
         *      security={{"bearerAuth":{}}},
         *      summary="Chat",
         *      description="index Chat",
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
         *          @OA\JsonContent(ref="#/components/schemas/ResChat"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/me', 'ChatController@indexMe');

        /**
         * @OA\Get(
         *      path="/chat/{service}/{uuid}",
         *      tags={"Chat"},
         *      security={{"bearerAuth":{}}},
         *      summary="Chat",
         *      description="index Chat",
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
         *     @OA\Parameter(
         *          name="service",
         *          description="service",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string",
         *              format="enum",
         *              enum={"wall_post"},
         *              default="project"
         *          )
         *      ),
         *      @OA\Response(
         *          response=201,
         *          description="No content"
         *       ),
         *     @OA\Response(
         *          response=200,
         *          description="successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResChat"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/{service}/{uuid}', 'ChatController@indexService');

        /**
         * @OA\Post(
         *      path="/chat/{service}/{uuid}",
         *      tags={"Chat"},
         *      security={{"bearerAuth":{}}},
         *      summary="store Chat",
         *      description="store ",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqStoreChat")
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
         *     @OA\Parameter(
         *          name="service",
         *          description="service",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string",
         *              format="enum",
         *              enum={"wall"},
         *              default="wall"
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
        Route::post('/{service}/{uuid}', 'ChatController@store');


    });
    #endregion
});
