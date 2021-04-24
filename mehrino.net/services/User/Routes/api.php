<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    //sw:comment:readonly
    #region user
    Route::group(['prefix' => 'user'], function () {
        /**
         * @OA\Get(
         *      path="/user/me",
         *      tags={"User"},
         *      summary="profile",
         *      security={{"bearerAuth":{}}},
         *      description="show user",
         *      @OA\Response(
         *          response=200,
         *          description="successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ResUserShow")
         *       ),
         *      @OA\Response(response=401, description="When  does not exist token in header"),
         *      @OA\Response(response=403, description="When the user does not exist"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('me', 'UserController@show')->middleware('auth:api');

        /**
         * @OA\Get(
         *      path="/user/{uuid}",
         *      tags={"User"},
         *      summary="show profile",
         *      security={{"bearerAuth":{}}},
         *      description="show user",
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
         *          description="successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ResUserShow")
         *       ),
         *      @OA\Response(response=401, description="When  does not exist token in header"),
         *      @OA\Response(response=403, description="When the user does not exist"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('/{uuid}', 'UserController@showUser');

        /**
         * @OA\Post(
         *      path="/user/me",
         *      tags={"User"},
         *      summary="Put",
         *      security={{"bearerAuth":{}}},
         *      description="user update",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\MediaType(
         *              mediaType="multipart/form-data",
         *               @OA\Schema(ref="#/components/schemas/ReqUser")
         *          )
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="successful operation"
         *       ),
         *      @OA\Response(response=401, description="When  does not exist token in header"),
         *      @OA\Response(response=403, description="When the user does not exist"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('me', 'UserController@store')->middleware('auth:api');

        /**
         * @OA\Get(
         *      path="/user/health",
         *      tags={"User"},
         *      summary="Get project information",
         *      description="Returns project data",
         *      @OA\Response(
         *          response=200,
         *          description="successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ResUserVerify")
         *       ),
         *      @OA\Response(response=404, description="Resource Not Found"),
         * )
         */
        Route::get('/health', 'UserController@health');
    });
    #endregion
    #region auth
    Route::group(['prefix' => 'auth'], function () {
        /**
         * @OA\Post(
         *      path="/auth/sign",
         *      tags={"Auth"},
         *      summary="User Sign In",
         *      description="user sign with mobile and email",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/UserSign")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="successful operation",
         *       ),
         *      @OA\Response(response=400, description="Bad Request If the username (phone or email) is incorrect or blocked;"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('sign', 'AuthController@sign');

        /**
         * @OA\Post(
         *      path="/auth/signin",
         *      tags={"Auth"},
         *      deprecated=true,
         *      summary="User Sign In",
         *      description="user sign with mobile and email",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/UserSignIn")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ResUserVerify")
         *       ),
         *      @OA\Response(response=400, description="Bad Request If the username (phone or email) is incorrect or blocked;"),
         *      @OA\Response(response=403, description="When the user does not exist"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('signin', 'AuthController@signin');

        /**
         * @OA\Post(
         *      path="/auth/signup",
         *      tags={"Auth"},
         *      deprecated=true,
         *      summary="signup",
         *      description="user sign with mobile and email",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/UserSignUp")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="successful operation"
         *       ),
         *      @OA\Response(response=403, description="When the user does exist;"),
         *      @OA\Response(response=400, description="Bad Request If the username (phone or email) is incorrect or blocked;"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('signup', 'AuthController@signup');

        /**
         * @OA\Post(
         *      path="/auth/verify",
         *      tags={"Auth"},
         *      summary="verify",
         *      description="This is for mobile and email verification and Sign up code is last 4 digits from mobile number or 1001",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqUserVerify")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="verify was successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResUserVerify")
         *       ),
         *      @OA\Response(response=400, description="Bad Request If the code is not correct;"),
         *      @OA\Response(response=403, description="When the user does not exist;"),
         *      @OA\Response(response=406, description="When the code has expired"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('verify', 'AuthController@verify');

        /**
         * @OA\Post(
         *      path="/auth/otp",
         *      tags={"Auth"},
         *      summary="Otp",
         *      description="Resend Otp to email and mobile.",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqOtp")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="otp was successful"
         *       ),
         *      @OA\Response(response=400, description="Bad Request If the mobile or email or type is incorrect"),
         *      @OA\Response(response=403, description="When the user does not exist"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('otp', 'AuthController@otp');

        /**
         * @OA\Get(
         *      path="/auth/revoke",
         *      tags={"Auth"},
         *      summary="revoke",
         *      security={{"bearerAuth":{}}},
         *      description="user revoke",
         *      @OA\Response(
         *          response=200,
         *          description="successful operation"
         *       ),
         *      @OA\Response(response=401, description="When  does not exist token in header"),
         *      @OA\Response(response=403, description="When the user does not exist"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::get('revoke', 'AuthController@revoke')->middleware('auth:api');

//        Route::get('/captain/{username}', 'AuthController@captain');


    });
    #endregion
    #region social
    Route::group(['prefix' => 'social'], function () {
        Route::get('/', 'SocialController@redirect')->name('social.redirect');
        Route::get('/callback', 'SocialController@callback')->name('social.callback');
        /**
         * @OA\Post(
         *      path="/social/verify",
         *      tags={"Auth"},
         *      summary="social verify",
         *      description="When you sign with Google and receive a token from Google, you call this address and receive the JWT token from MihreNo and save it in your storage for using in other APIs.",
         *      @OA\RequestBody(
         *          required=true,
         *          @OA\JsonContent(ref="#/components/schemas/ReqGoogleVerify")
         *      ),
         *      @OA\Response(
         *          response=200,
         *          description="verify was successful",
         *          @OA\JsonContent(ref="#/components/schemas/ResUserVerify")
         *       ),
         *      @OA\Response(response=400, description="Bad Request token is not valid;"),
         *      @OA\Response(response=500, description="Server Internal Error"),
         * )
         */
        Route::post('/verify', 'SocialController@verify');
    });
    #endregion
});
