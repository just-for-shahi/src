<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('expert.advisor')->prefix('v1')->group(function(){
    Route::group(['prefix' => 'maccounts'], function(){
        Route::post('update', 'MAccount\APIController@update');
    });
});
