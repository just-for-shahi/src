<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly
    #region transaction
    Route::group(['prefix' => 'transaction'], function () {

        /**
         * @OA\Get(
         *      path="/transaction",
         *      tags={"Transaction"},
         *      security={{"bearerAuth":{}}},
         *      summary="Transaction",
         *      description="index Transaction",
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
         *          @OA\JsonContent(ref="#/components/schemas/ResTransaction"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/', 'TransactionController@index')->middleware('auth:api');

        /**
         * @OA\Post(
         *      path="/transaction/{service}/{uuid}",
         *      tags={"Transaction"},
         *      security={{"bearerAuth":{}}},
         *      summary="store Transaction",
         *      description="store ",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqStoreTransaction")
         *      ),
         *     @OA\Parameter(
         *          name="service",
         *          description="service",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *               type="string",
         *               format="enum",
         *               enum={"wallet", "project"},
         *               default="project"
         *          )
         *      ),
         *     @OA\Parameter(
         *          name="uuid",
         *          description="uuid is not required for wallet",
         *          required=false,
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
        Route::post('/{service}/{uuid?}', 'TransactionController@store')->middleware('auth:api');
        /**
         * @OA\Post(
         *      path="/transaction/wallet",
         *      tags={"Transaction with wallet"},
         *      security={{"bearerAuth":{}}},
         *      summary="store Transaction",
         *      description="store ",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqStoreTransaction")
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
        Route::group(['prefix' => 'gateway'], function () {
            Route::get('/start_payment/{authority}', 'GatewayController@start_payment')->name('start_payment');
            Route::get('/callback_payment/{authority}', 'GatewayController@callback_payment')->name('callback_payment');

            Route::get('/test_gateway/{authority}', 'GatewayController@test_gateway')->name('test_gateway');
        });
        Route::get('/callback', 'TransactionController@callback')->name('callback');
    });
    #endregion
});
