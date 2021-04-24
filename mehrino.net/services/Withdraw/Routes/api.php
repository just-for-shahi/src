<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region withdraw
  Route::group(['prefix' => 'withdraw'], function () {

    /**
     * @OA\Get(
     *      path="/withdraw",
     *      tags={"Withdraw"},
     *      security={{"bearerAuth":{}}},
     *      summary="Withdraw",
     *      description="index Withdraw",
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
     *          @OA\JsonContent(ref="#/components/schemas/ResWithdraw"),
     *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
     *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/', 'WithdrawController@index');

      /**
       * @OA\Post(
       *      path="/withdraw",
       *      tags={"Withdraw"},
       *      summary="store Withdraw",
       *      description="store ",
       *      @OA\RequestBody(
       *          required=true,
       *          @OA\JsonContent(ref="#/components/schemas/ReqStoreWithdraw")
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
      Route::post('/', 'WithdrawController@store');

      /**
       * @OA\Get(
       *      path="/withdraw/:uuid",
       *      tags={"Withdraw"},
       *      security={{"bearerAuth":{}}},
       *      summary="show",
       *      description="show Withdraw",
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
       *          @OA\JsonContent(ref="#/components/schemas/ResShowWithdraw"),
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::get('/{uuid}', 'WithdrawController@show');

      /**
       * @OA\Put(
       *      path="/withdraw/:uuid",
       *      tags={"Withdraw"},
       *      security={{"bearerAuth":{}}},
       *      summary="update",
       *      description="update Withdraw",
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
       *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateWithdraw")
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
      Route::put('/{uuid}', 'WithdrawController@update');

      /**
       * @OA\Delete(
       *      path="/withdraw/:uuid",
       *      tags={"Withdraw"},
       *      security={{"bearerAuth":{}}},
       *      summary="destroy",
       *      description="Delete Withdraw",
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
      Route::delete('/{uuid}', 'WithdrawController@destroy');
  });
  #endregion
});