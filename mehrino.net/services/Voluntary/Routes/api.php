<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly

    Route::group(['prefix' => 'voluntary'], function () {
        #region Voluntary
        Route::group(['prefix' => 'request'], function () {

            /**
             * @OA\Get(
             *      path="/voluntary/request/{uuid}",
             *      tags={"Voluntary"},
             *      security={{"bearerAuth":{}}},
             *      summary="Voluntary",
             *      description="index Voluntary request",
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
             *          @OA\JsonContent(ref="#/components/schemas/ResVoluntary"),
             *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
             *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
             *      ),
             *     @OA\Response(response=400, description="Bad Request"),
             *     @OA\Response(response=401, description="UnAuthorization"),
             *     @OA\Response(response=404, description="Resource Not Found"),
             *     @OA\Response(response=500, description="Server Internal Error"),
             * )
             */
            Route::get('/{uuid}', 'VoluntaryRequestController@index');
            /**
             * @OA\Post(
             *      path="/voluntary/request/{uuid}",
             *      tags={"Voluntary"},
             *      security={{"bearerAuth":{}}},
             *      summary="store Voluntary request",
             *      description="store ",
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
             *          @OA\MediaType(
             *              mediaType="multipart/form-data",
             *               @OA\Schema(ref="#/components/schemas/ReqStoreRequestVoluntary")
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
            Route::post('/{uuid}', 'VoluntaryRequestController@store')->middleware('auth:api');
            /**
             * @OA\Patch(
             *      path="/voluntary/request/reject/{uuid}",
             *      tags={"Voluntary"},
             *      security={{"bearerAuth":{}}},
             *      summary="update",
             *      description="reject Voluntary request",
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
            Route::patch('reject/{uuid}', 'VoluntaryRequestController@reject')->middleware('auth:api');
        });
        #endregion
        #region voluntary

        /**
         * @OA\Get(
         *      path="/voluntary",
         *      tags={"Voluntary"},
         *      security={{"bearerAuth":{}}},
         *      summary="Voluntary",
         *      description="index Voluntary",
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
         *          @OA\JsonContent(ref="#/components/schemas/ResVoluntary"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/', 'VoluntaryWorkController@index');

        /**
         * @OA\Post(
         *      path="/voluntary",
         *      tags={"Voluntary"},
         *      security={{"bearerAuth":{}}},
         *      summary="store Voluntary",
         *      description="store ",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqStoreVoluntaryWork")
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
        Route::post('/', 'VoluntaryWorkController@store')->middleware('auth:api');

        /**
         * @OA\Get(
         *      path="/voluntary/{uuid}",
         *      tags={"Voluntary"},
         *      security={{"bearerAuth":{}}},
         *      summary="show",
         *      description="show Voluntary",
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
         *          @OA\JsonContent(ref="#/components/schemas/ResShowVoluntary"),
         *     ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/{uuid}', 'VoluntaryWorkController@show');

        /**
         * @OA\Put(
         *      path="/voluntary/{uuid}",
         *      tags={"Voluntary"},
         *      security={{"bearerAuth":{}}},
         *      deprecated=true,
         *      summary="update",
         *      description="update Voluntary",
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
         *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateVoluntary")
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
        Route::put('/{uuid}', 'VoluntaryWorkController@update')->middleware('auth:api');

        /**
         * @OA\Post(
         *      path="/voluntary/{uuid}",
         *      tags={"Voluntary"},
         *      security={{"bearerAuth":{}}},
         *      summary="update",
         *      description="update Voluntary",
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
         *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateVoluntary")
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
        Route::post('/{uuid}', 'VoluntaryWorkController@update')->middleware('auth:api');

        /**
         * @OA\Delete(
         *      path="/voluntary/{uuid}",
         *      tags={"Voluntary"},
         *      security={{"bearerAuth":{}}},
         *      summary="Delete",
         *      description="Delete Voluntary",
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
        Route::delete('/{uuid}', 'VoluntaryWorkController@destroy')->middleware('auth:api');

        #endregion
    });

});
