<?php

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

use Illuminate\Support\Facades\Route;

//Route::group(['prefix' => 'v1'], function(){
//    Route::group(['prefix' => 'auth'], function(){
//        Route::post('login', 'Rest\AuthController@login');
//        Route::post('register', 'Rest\AuthController@register');
//        Route::post('logout', 'Rest\AuthController@logout');
//    });
//    Route::get('/', 'Rest\DashboardController@index');
//    Route::group(['prefix' => 'profile'], function(){
//        Route::get('/', 'Rest\ProfileController@show');
//        Route::post('/', 'Rest\ProfileController@update');
//    });
//    Route::resources([
//        'accounts' => 'Rest\AccountController',
//        'investments' => 'Rest\InvestmentController',
//        'transactions' => 'Rest\TransactionController',
//        'activities' => 'Rest\ActivityController',
//        'call-requests' => 'Rest\CallRequestController',
//        'tickets' => 'Rest\TicketController',
//        'treply' => 'Rest\TicketReplyController',
//        'bank-accounts' => 'Rest\WalletController',
//        'withdraws' => 'Rest\WithdrawController',
//        'bank-transfers' => 'Rest\BankTransferController'
//    ]);
//    Route::get('/pay/{transaction}', 'Rest\TransactionController@pay');
//    Route::get('/payment/callback', 'Rest\TransactionController@callback')->name('rest.callback');
//});
