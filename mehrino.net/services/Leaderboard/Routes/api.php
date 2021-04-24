<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region leaderboard
  Route::group(['prefix' => 'leaderboard'], function () {

    /**
     * @OA\Get(
     *      path="/leaderboard",
     *      tags={"Leaderboard"},
     *      security={{"bearerAuth":{}}},
     *      summary="Leaderboard",
     *      description="index Leaderboard",
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
     *          @OA\JsonContent(ref="#/components/schemas/ResLeaderboard"),
     *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
     *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/', 'LeaderboardController@index');

      /**
       * @OA\Post(
       *      path="/leaderboard",
       *      tags={"Leaderboard"},
       *      summary="store Leaderboard",
       *      description="store ",
       *      @OA\RequestBody(
       *          required=true,
       *          @OA\JsonContent(ref="#/components/schemas/ReqStoreLeaderboard")
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
      Route::post('/', 'LeaderboardController@store');

      /**
       * @OA\Get(
       *      path="/leaderboard/{uuid}",
       *      tags={"Leaderboard"},
       *      security={{"bearerAuth":{}}},
       *      summary="show",
       *      description="show Leaderboard",
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
       *          @OA\JsonContent(ref="#/components/schemas/ResShowLeaderboard"),
       *     ),
       *     @OA\Response(response=400, description="Bad Request"),
       *     @OA\Response(response=401, description="UnAuthorization"),
       *     @OA\Response(response=404, description="Resource Not Found"),
       *     @OA\Response(response=500, description="Server Internal Error"),
       * )
       */
      Route::get('/{uuid}', 'LeaderboardController@show');

      /**
       * @OA\Put(
       *      path="/leaderboard/{uuid}",
       *      tags={"Leaderboard"},
       *      security={{"bearerAuth":{}}},
       *      summary="update",
       *      description="update Leaderboard",
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
       *          @OA\JsonContent(ref="#/components/schemas/ReqUpdateLeaderboard")
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
      Route::put('/{uuid}', 'LeaderboardController@update');

      /**
       * @OA\Delete(
       *      path="/leaderboard/{uuid}",
       *      tags={"Leaderboard"},
       *      security={{"bearerAuth":{}}},
       *      summary="destroy",
       *      description="Delete Leaderboard",
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
      Route::delete('/{uuid}', 'LeaderboardController@destroy');
  });
  #endregion
});
