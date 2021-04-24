<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
  //sw:comment:readonly
  #region story
  Route::group(['prefix' => 'story'], function () {

    /**
     * @OA\Get(
     *      path="/story",
     *      tags={"Story"},
     *      security={{"bearerAuth":{}}},
     *      summary="Story",
     *      description="index Story",
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
     *          @OA\JsonContent(@OA\Items(ref="#/components/schemas/ResUserStory")),
     *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
     *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/', 'StoryController@index');
    /**
     * @OA\Get(
     *      path="/story/me",
     *      tags={"Story"},
     *      security={{"bearerAuth":{}}},
     *      summary="my Story",
     *      description="my Story",
     *     @OA\Response(
     *          response=200,
     *          description="successful",
     *          @OA\JsonContent(@OA\Items(ref="#/components/schemas/ResStory")),
     *          @OA\Header(header="x-page", ref="#/components/headers/x-page"),
     *          @OA\Header(header="x-count", ref="#/components/headers/x-count")
     *      ),
     *     @OA\Response(response=400, description="Bad Request"),
     *     @OA\Response(response=401, description="UnAuthorization"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\Response(response=500, description="Server Internal Error"),
     * )
     */
      Route::get('/me', 'StoryController@myIndex')->middleware('auth:api');

      /**
       * @OA\Post(
       *      path="/story",
       *      tags={"Story"},
       *      summary="store Story",
       *      security={{"bearerAuth":{}}},
       *      description="store ",
       *      @OA\RequestBody(
       *          required=true,
       *          @OA\MediaType(
       *              mediaType="multipart/form-data",
       *               @OA\Schema(ref="#/components/schemas/ReqStoreStory")
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
      Route::post('/', 'StoryController@store');

      /**
       * @OA\Delete(
       *      path="/story/{uuid}",
       *      tags={"Story"},
       *      security={{"bearerAuth":{}}},
       *      summary="destroy",
       *      description="Delete Story",
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
      Route::delete('/{uuid}', 'StoryController@destroy');
  });
  #endregion
});
