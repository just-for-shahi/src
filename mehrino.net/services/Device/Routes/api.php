<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region device
  Route::group(['prefix' => 'device'], function () {

    /**
     * @OA\Get(
     *      path="/device",
     *      tags={"Device"},
     *      security={{"bearerAuth":{}}},
     *      summary="Device",
     *      description="index Device",
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
     *          @OA\JsonContent(ref="#/components/schemas/ResDevice"),
     *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
     *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/', 'DeviceController@index');

      /**
       * @OA\Post(
       *      path="/device",
       *      tags={"Device"},
       *      summary="store Device",
       *      description="store ",
       *      @OA\RequestBody(
       *          required=true,
       *          @OA\JsonContent(ref="#/components/schemas/ReqStoreDevice")
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
      Route::post('/', 'DeviceController@store');

      /**
       * @OA\Get(
       *      path="/device/:uuid",
       *      tags={"Device"},
       *      security={{"bearerAuth":{}}},
       *      summary="show",
       *      description="show Device",
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
       *          @OA\JsonContent(ref="#/components/schemas/ResShowDevice"),
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::get('/{uuid}', 'DeviceController@show');

      /**
       * @OA\Put(
       *      path="/device/:uuid",
       *      tags={"Device"},
       *      security={{"bearerAuth":{}}},
       *      summary="update",
       *      description="update Device",
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
       *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateDevice")
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
      Route::put('/{uuid}', 'DeviceController@update');

      /**
       * @OA\Delete(
       *      path="/device/:uuid",
       *      tags={"Device"},
       *      security={{"bearerAuth":{}}},
       *      summary="destroy",
       *      description="Delete Device",
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
      Route::delete('/{uuid}', 'DeviceController@destroy');
  });
  #endregion
});