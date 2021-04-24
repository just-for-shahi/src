<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly

    #region report
    Route::group(['prefix' => '{service}/{uuid}/report'], function () {
        /**
         * @OA\Get(
         *      path="/{service}/{uuid}/report",
         *      tags={"Report"},
         *      summary="Report",
         *      description="index Report",
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
         *              enum={"project", "voluntary"},
         *              default="project"
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
         *          @OA\JsonContent(ref="#/components/schemas/ResReport"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/', 'ReportController@index');

        /**
         * @OA\Post(
         *      path="/{service}/{uuid}/report",
         *      tags={"Report"},
         *      security={{"bearerAuth":{}}},
         *      summary="store Report",
         *      description="store ",
         *      @OA\Parameter(
         *          name="service",
         *          description="service",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="string",
         *              format="enum",
         *              enum={"project", "voluntary"},
         *              default="project"
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
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqStoreReport")
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
        Route::post('/', 'ReportController@store')->middleware('auth:api');
    });
    #endregion
});
