<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly
    #region ticket
    Route::group(['prefix' => 'complaint'], function () {
        /**
         * @OA\Post(
         *      path="/complaint",
         *      tags={"Support"},
         *      summary="complaint",
         *      description="complaint",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqCallRequest")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="verify was successful"
         *       ),
         *      @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        Route::post('/', 'CallRequestController@store');
    });
    Route::group(['prefix' => 'faqs'], function () {
        /**
         * @OA\Get(
         *      path="/faqs",
         *      tags={"Support"},
         *      summary="Faqs",
         *      description="index Faqs",
         *      @OA\Response(
         *          response=200,
         *          description="verify was successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResFaq")
         *       ),
         *      @OA\Response(
         *          response=204,
         *          description="Successful operation",
         *          @OA\JsonContent()
         *       ),
         *      @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        Route::get('/', 'FaqController@index');
    });
    #endregion
    #region ticket
    Route::group(['prefix' => 'ticket', 'middleware' => 'auth:api'], function () {
        /**
         * @OA\Get(
         *      path="/ticket",
         *      tags={"ticket"},
         *      security={{"bearerAuth":{}}},
         *      summary="ticket",
         *      description="index ticket",
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
         *          description="ticket was successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResTicket"),
         *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
         *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
         *      ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/', 'TicketController@index');
        /**
         * @OA\Post(
         *      path="/ticket",
         *      tags={"ticket"},
         *      security={{"bearerAuth":{}}},
         *      summary="ticket",
         *      description="store  ticket",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqTicket")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="ticket was successful"
         *       ),
         *      @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        Route::post('/', 'TicketController@store');
        /**
         * @OA\Get(
         *      path="/ticket/{uuid}",
         *      tags={"ticket"},
         *      security={{"bearerAuth":{}}},
         *      summary="ticket",
         *      description="show ticket",
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
         *      @OA\Response(
         *          response=200,
         *          description="successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResTicket")
         *       ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/{uuid}', 'TicketController@show');
        /**
         * @OA\Post(
         *      path="/ticket/reply/{uuid}",
         *      tags={"ticket"},
         *      security={{"bearerAuth":{}}},
         *      summary="reply",
         *      description="store  reply",
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
         *          @OA\JsonContent(ref="#/components/schemas/ReqReply")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="reply was successful"
         *       ),
         *      @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        Route::post('/reply/{uuid}', 'TicketController@reply');
        /**
         * @OA\Delete(
         *      path="/ticket/{uuid}",
         *      tags={"ticket"},
         *      summary="ticket",
         *      security={{"bearerAuth":{}}},
         *      description="delete ticket",
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
         *      @OA\Response(
         *          response=200,
         *          description="successful",
         *       ),
         *     @OA\Response(response=400, description="Bad Request"),
         *     @OA\Response(response=401, description="UnAuthorization"),
         *     @OA\Response(response=404, description="Resource Not Found"),
         *     @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::delete('/{uuid}', 'TicketController@destroy');
    });
    #endregion
});
