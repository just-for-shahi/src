<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region credit
  Route::group(['prefix' => 'credit'], function () {

    /**
     * @OA\Get(
     *      path="/credit",
     *      tags={"Credit"},
     *      security={{"bearerAuth":{}}},
     *      summary="Credit",
     *      description="index Credit",
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
     *          @OA\JsonContent(ref="#/components/schemas/ResCredit"),
     *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
     *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/', 'CreditController@index');

      /**
       * @OA\Post(
       *      path="/credit",
       *      tags={"Credit"},
       *      summary="store Credit",
       *      description="store ",
       *      @OA\RequestBody(
       *          required=true,
       *          @OA\JsonContent(ref="#/components/schemas/ReqStoreCredit")
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
      Route::post('/', 'CreditController@store');

      /**
       * @OA\Get(
       *      path="/credit/:uuid",
       *      tags={"Credit"},
       *      security={{"bearerAuth":{}}},
       *      summary="show",
       *      description="show Credit",
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
       *          @OA\JsonContent(ref="#/components/schemas/ResShowCredit"),
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::get('/{uuid}', 'CreditController@show');

      /**
       * @OA\Put(
       *      path="/credit/:uuid",
       *      tags={"Credit"},
       *      security={{"bearerAuth":{}}},
       *      summary="update",
       *      description="update Credit",
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
       *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateCredit")
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
      Route::put('/{uuid}', 'CreditController@update');

      /**
       * @OA\Delete(
       *      path="/credit/:uuid",
       *      tags={"Credit"},
       *      security={{"bearerAuth":{}}},
       *      summary="destroy",
       *      description="Delete Credit",
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
      Route::delete('/{uuid}', 'CreditController@destroy');
  });
  #endregion
});