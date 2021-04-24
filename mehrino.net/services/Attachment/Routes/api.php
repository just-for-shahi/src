<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly
    #region category
    Route::group(['prefix' => 'attachment'], function () {

        Route::get('/test1', 'AttachmentController@test1');
        Route::get('/test2', 'AttachmentController@test2');

        /**
         * @OA\Post(
         *      path="/attachment/gallery",
         *      tags={"Attachment"},
         *      security={{"bearerAuth":{}}},
         *      summary="destroy",
         *      description="Gallery",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqGallery")
         *          )
         *      ),
         *     @OA\Response(
         *          response=201,
         *          description="successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResGallery"),
         *     ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('/gallery', 'AttachmentController@gallery')->middleware('auth:api');
        /**
         * @OA\Delete(
         *      path="/attachment/{uuid}",
         *      tags={"Attachment"},
         *      security={{"bearerAuth":{}}},
         *      summary="destroy",
         *      description="Delete Category",
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
        Route::delete('/{uuid}', 'AttachmentController@destroy');
    });
    #endregion
});
