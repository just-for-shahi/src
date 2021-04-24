<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'Controller@docs')->name('api.docs');

Route::get('callback/user/auth/verify/{email}', 'Account\AuthController@emailCallback')->name('callback.verify.email');

Route::get('/social' , 'SocialController@redirect');
Route::get('/social/callback' , 'SocialController@callback');

Route::group(['prefix' => 'auth'], function(){
    Route::get('/', 'Account\oAuthController@redirect');
    Route::get('/callback', 'Account\oAuthController@callback');
});
Route::get('/pay/{uuid}', 'Finance\TransactionController@pay')->name('payment.go');
Route::get('/callback', 'Finance\TransactionController@callback')->name('payment.callback');