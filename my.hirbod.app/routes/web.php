<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/tmp', 'Controller@tmp');


Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'DashboardController@index')->name('index');
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'ProfileController@show')->name('profile.show');
        Route::post('/', 'ProfileController@update')->name('profile.update');
    });
    Route::resources([
        'episods' => 'Podcast\EpisodController',
        'courses' => 'Course\Controller',
    ]);
    Route::group(['prefix' => 'ebooks'], function(){
        Route::get('/', 'EBook\Controller@index')->name('ebooks.index');
        Route::get('/create', 'EBook\Controller@create')->name('ebooks.create');
        Route::post('/store', 'EBook\Controller@store')->name('ebooks.store');
        Route::get('/show/{uuid}', 'EBook\Controller@show')->name('ebooks.show');
        Route::post('/update/{uuid}', 'EBook\Controller@update')->name('ebooks.update');
        Route::delete('/destroy/{uuid}', 'EBook\Controller@destroy')->name('ebooks.destroy');
    });
    Route::group(['prefix' => 'podcasts'], function(){
        Route::get('/', 'Podcast\Controller@index')->name('podcasts.index');
        Route::get('/create', 'Podcast\Controller@create')->name('podcasts.create');
        Route::post('/store', 'Podcast\Controller@store')->name('podcasts.store');
        Route::get('/show/{uuid}', 'Podcast\Controller@show')->name('podcasts.show');
        Route::post('/update/{uuid}', 'Podcast\Controller@update')->name('podcasts.update');
        Route::delete('/destroy/{podcast}', 'Podcast\Controller@destroy')->name('podcasts.destroy');
        Route::get('/episodes/{uuid}', 'Podcast\Controller@episodes')->name('podcasts.episodes');
        Route::delete('/episodes/destroy/{uuid}', 'Podcast\Controller@episodeDestroy')->name('episodes.destroy');
    });
    Route::group(['prefix' => 'courses'], function(){
        Route::get('/', 'Course\Controller@index')->name('courses.index');
        Route::get('/create', 'Course\Controller@create')->name('courses.create');
        Route::post('/store', 'Course\Controller@store')->name('courses.store');
        Route::get('/{uuid}/show', 'Course\Controller@show')->name('courses.show');
        Route::delete('{uuid}/destroy', 'Course\Controller@destroy')->name('courses.destroy');
        Route::post('/{uuid}/update', 'Course\Controller@update')->name('courses.update');
        Route::group(['prefix' => '{uuid}/lectures'], function(){
            Route::get('/', 'Course\LectureController@index')->name('lectures.index');
            Route::post('/store', 'Course\LectureController@store')->name('lectures.store');
            Route::delete('/{luuid}/destroy/', 'Course\LectureController@destroy')->name('lectures.destroy');
        });
    });
    Route::group(['prefix' => 'tickets'], function(){
        Route::get('/', 'Ticket\Controller@index')->name('tickets.index');
        Route::get('/create', 'Ticket\Controller@create')->name('tickets.create');
        Route::post('/store', 'Ticket\Controller@store')->name('tickets.store');
        Route::get('/destroy/{uuid}', 'Ticket\Controller@destroy')->name('tickets.destroy');
        Route::get('/show/{uuid}', 'Ticket\Controller@show')->name('tickets.show');
        Route::post('/reply/{uuid}', 'Ticket\Controller@reply')->name('tickets.reply');
    });
    Route::group(['prefix' => 'finance'], function(){
        Route::group(['prefix' => 'transactions'], function(){
            Route::get('/', 'Finance\TransactionController@index')->name('transactions.index');
            Route::get('/{uuid}', 'Finance\TransactionController@show')->name('transactions.show');
        });
        Route::group(['prefix' => 'payment'], function(){
            Route::get('/pay/{uuid}', 'Finance\PaymentController@payment')->name('payment.pay');
            Route::get('/callback', 'Finance\PaymentController@callback')->name('payment.callback');
        });
        Route::group(['prefix' => 'wallet'], function(){
            Route::get('/', 'Finance\WalletController@show')->name('wallet');
            Route::post('/pay', 'Finance\WalletController@pay')->name('wallet.pay');
        });
    });
    Route::group(['middleware' => 'milad'], function(){
        Route::get('/milad', 'Milad\DashboardController@index')->name('m.dashboard');
        Route::resources([
            'musers' => 'Milad\UserController',
            'mcategories' => 'Milad\CategoryController',
            'mpodcasts' => 'Milad\PodcastController',
            'mcourses' => 'Milad\CourseController',
        ]);
    });
});
