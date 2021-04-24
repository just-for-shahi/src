<?php

use App\Facades\Rest\Rest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'auth'], function () {
         Route::post('sign', 'Account\AuthController@sign');
         Route::post('verify', 'Account\AuthController@verify');
         Route::post('otp', 'Account\AuthController@otp');
         Route::get('revoke', 'Account\AuthController@revoke')->middleware('auth:api');
         Route::get('/captain/{username}', 'Account\AuthController@captain');
         Route::post('device', 'Account\AuthController@device')->middleware('auth:api');
         Route::group(['prefix' => 'social'], function(){
//            Route::get('/', 'Account\AuthController@redirectToProvider')->name('provider.redirect');
//            Route::get('/callback', 'Account\AuthController@callBackProvider')->name('provider.callback');
//             Route::get('/', 'SocialController@redirect')->name('social.redirect');
//             Route::get('/callback', 'SocialController@callback')->name('social.callback');
             Route::post('/verify', 'SocialController@verify');
        });
     });

    Route::group(['middleware' => 'auth:api'], function(){
        Route::group(['prefix' => 'account'], function () {
            Route::get('/', 'Account\AccountController@show');
            Route::post('/update', 'Account\AccountController@update');
            Route::post('/avatar' , 'Account\AccountController@avatar')->middleware('auth:api');
            Route::group(['prefix' => 'team'], function () {
                Route::get('/', 'Account\TeamController@index');
                Route::post('join', 'Account\TeamController@join');
            });
            Route::group(['prefix' => 'session'], function () {
                Route::get('/', 'Account\SessionController@index');
                Route::post('revoke', 'Account\SessionController@revoke');
            });
            Route::group(['prefix' => 'setting'], function(){
                Route::get('/', 'Account\Setting\GeneralController@index');
                Route::put('/update', 'Account\Setting\GeneralController@update');
                Route::group(['prefix' => 'twoStep'], function(){
                    Route::post('active', 'Account\Setting\TwoStepController@store');
                    Route::get('/verify/{token}', 'Account\Setting\TwoStepController@verify');
                });
                Route::resource('notifications', 'Account\Setting\NotificationController')->only(['index', 'update']);
            });
            Route::post('blueTick', 'Account\BlueTickController@store');
        });
        Route::group(['prefix' => 'finance'], function(){
//            Route::resource('bankAccounts', 'Finance\BankAccountRestController');
//            Route::resource('withdraws', 'Finance\WithdrawController');
            Route::resource('credits', 'Finance\CreditController')->only(['index','show']);
            Route::resource('transactions', 'Finance\TransactionController')->only(['index','show']);
            Route::group(['prefix' => 'transactions'], function(){
                Route::get('/', 'Finance\TransactionController@index');
                Route::get('/{uuid}/show', 'Finance\TransactionController@show');
            });
            Route::post('charge', 'Finance\WalletController@charge');
            Route::post('plus', 'Finance\PlusController@purchase');
            Route::post('/purchase', 'Finance\PurchaseController@purchase')->middleware('auth:api');
        });
    });
    Route::post('finance/charge/phone', 'Finance\WalletController@chargePhone');
    Route::group(['prefix' => 'support'], function (){
        Route::resource('faqs', 'Support\FaqController')->only(['index']);
        Route::resource('calls', 'Support\CallController')->only(['store','destroy']);
        Route::resource('complaints', 'Support\ComplaintController')->only(['index','store']);
        Route::resource('tickets', 'Support\TicketController')->middleware('auth:api');
        Route::post('reply', 'Support\TicketController@reply')->middleware('auth:api');
    });
    Route::get('callback', 'Finance\PaymentController@callback')->name('callback');
    Route::get('/finance/transactions/{authority}/check', 'Finance\TransactionController@check');
    Route::group(['prefix' => 'events'], function(){
        Route::post('/register/{code}', 'Event\RestController@register');
        Route::get('/callback', 'Event\RestController@callback')->name('api.events.callback');
        Route::get('/info/{token}', 'Event\RestController@info');

    });
    Route::group(['prefix' => 'ebooks'], function(){
        Route::get('/','EBook\Controller@index');
        Route::get('{uuid}/show','EBook\Controller@show');
        Route::post('/{uuid}/like', 'EBook\Controller@like')->middleware('auth:api');
    });
    Route::group(['prefix' => 'podcasts'], function(){
        Route::get('/', 'Podcast\Controller@index');
        Route::get('/{uuid}/show', 'Podcast\Controller@show');
        Route::post('/{uuid}/like', 'Podcast\Controller@like')->middleware('auth:api');
        Route::post('/{uuid}/play', 'Podcast\Controller@play')->middleware('auth:api');
    });
    Route::group(['prefix' => 'courses'], function(){
        Route::get('/', 'Course\Controller@index');
        Route::get('/{uuid}/show', 'Course\Controller@show');
        Route::post('/{uuid}/like', 'Course\Controller@like')->middleware('auth:api');
        Route::post('/{uuid}/play', 'Course\Controller@play')->middleware('auth:api');
    });
    Route::prefix('events')->group(function(){
        Route::get('/', 'Event\Controller@index');
        Route::get('/{uuid}/show', 'Event\Controller@show');
        Route::post('/{uuid}/like', 'Event\Controller@like')->middleware('auth:api');
        Route::post('/store', 'Event\Controller@store')->middleware('auth:api');
        Route::delete('/delete/{uuid}', 'Event\Controller@destroy')->middleware('auth:api');
    });
    Route::get('search', 'GeneralController@search');
    Route::get('/home', 'GeneralController@home');
    Route::get('/tags/', 'Tag\Controller@index');
    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', 'Category\Controller@index');
        Route::get('/{uuid}', 'Category\Controller@show');
    });
    Route::group(['prefix' => 'library'], function(){
        Route::group(['prefix' => 'my'], function(){
            Route::group(['prefix' => 'ebooks'], function(){
                Route::get('/', 'Ebook\RestController@myIndex');
                Route::get('/show/{ebook}', 'Ebook\RestController@myShow');
            });
        });
        Route::get('ebooks', 'EBook\RestController@myPurchase')->middleware('auth:api');
        Route::get('events', 'Event\RestController@myPurchase')->middleware('auth:api');
        Route::get('podcasts', 'Podcast\RestController@myPurchase')->middleware('auth:api');
//        Route::get('courses', 'Course\RestController@myPurchase')->middleware('auth:api');
    });
    Route::middleware(['auth:api'])->prefix('story')->group(function(){
        Route::post('send', 'Story\RestController@Send');
        Route::get('show/{story}', 'Story\RestController@show');
        Route::post('update/{story}', 'Story\RestController@update');
        Route::delete('delete/{story}', 'Story\RestController@delete');
        Route::post('like/{story}', 'Story\RestController@like');
        Route::get('user', 'Story\RestController@user');
        Route::get('others', 'Story\RestController@others');
    });
    Route::group(['prefix' => 'my', 'middleware' => 'auth:api'], function(){
        Route::group(['prefix' => 'ebooks'], function(){
            Route::get('/', 'EBook\MyController@index');
            Route::post('/store', 'EBook\MyController@store');
            Route::get('/show/{uuid}', 'EBook\MyController@show');
            Route::put('/update/{uuid}', 'EBook\MyController@update');
            Route::delete('/delete/{uuid}', 'EBook\MyController@destroy');
        });
        // TODO Event
//        Route::group(['prefix' => 'events'], function(){
//            Route::get('/', 'Event\MyController@index');
//            Route::post('/store', 'Event\MyController@store');
//            Route::get('/show/{uuid}', 'Event\MyController@show');
//            Route::put('/update/{uuid}', 'Event\MyController@update');
//            Route::delete('/delete/{uuid}', 'Event\MyController@destroy');
//        });
        Route::prefix('courses')->namespace('Course')->middleware('auth:api')->group(function () {
            Route::get('/' , 'MyController@index');
            Route::post('/store' , 'MyController@store');
            Route::post('/update/{uuid}' , 'MyController@update');
            Route::delete('/delete/{uuid}' , 'MyController@destroy');
        });
        Route::group(['prefix' => 'podcasts'], function(){
            Route::get('/', 'Podcast\MyController@index');
            Route::post('/store', 'Podcast\MyController@store');
            Route::get('/show/{uuid}', 'Podcast\MyController@show');
        });
        Route::group(['prefix' => 'episodes'], function(){
//            Route::post('/store', 'Episode\MyController@storeEpisode');
        });

    });
    Route::middleware('auth:api')->prefix('comment')->group(function () {
            Route::post('/' , 'CommentController@store');
            Route::post('/like' , 'CommentController@like');
            Route::post('/dislike' , 'CommentController@dislike');
        });
    Route::get('/healthcheck' , function () {
        return ['version' => '1.1.4'];
    });
//    Route::get('/truncate/transaction' , function () {
//        DB::table('transactions')->truncate();
//    });
});