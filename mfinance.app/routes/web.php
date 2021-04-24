<?php

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

if (config('app.env') === 'local') {
    Route::get('utest', static function () {
        auth()->login(\App\Http\Controllers\Account\Account::firstOrFail());
        return redirect()->route('dashboard');
    });
}
Route::get('/', 'FrontController@index')->name('index');

Route::group(['prefix' => 'pages'], function () {
    Route::get('/about', 'FrontController@about')->name('pages.about');
    Route::get('/contact', 'FrontController@contact')->name('pages.contact');
    Route::get('/faq', 'FrontController@faq')->name('pages.faq');
    Route::get('/privacy-policy', 'FrontController@privacy')->name('pages.privacy');
    Route::get('/terms', 'FrontController@terms')->name('pages.terms');
});
Route::group(['prefix' => 'pages/ar'], function(){
    Route::get('/', 'FrontArbicController@index')->name('index');   
    Route::get('/about', 'FrontArbicController@about')->name('pages-ar.about');   
    Route::get('/contact', 'FrontArbicController@contact')->name('pages-ar.contact');   
    Route::get('/faq', 'FrontArbicController@faq')->name('pages-ar.faq');
    Route::get('/privacy-policy','FrontArbicController@privacy')->name('pages-ar.privacy');
    Route::get('/terms', 'FrontArbicController@terms')->name('pages-ar.terms');
});
Route::group(['prefix' => 'pages/pe'], function(){
    Route::get('/', 'FrontPersianController@index')->name('index');   
    Route::get('/about', 'FrontPersianController@about')->name('pages-pe.about');   
    Route::get('/contact', 'FrontPersianController@contact')->name('pages-pe.contact');   
    Route::get('/faq', 'FrontPersianController@faq')->name('pages-pe.faq');
    Route::get('/privacy-policy','FrontPersianController@privacy')->name('pages-pe.privacy');
    Route::get('/terms', 'FrontPersianController@terms')->name('pages-pe.terms');
});
Route::group(['prefix' => 'pages/tu'], function(){
    Route::get('/', 'FrontTurkishController@index')->name('index');   
    Route::get('/about', 'FrontTurkishController@about')->name('pages-tu.about');   
    Route::get('/contact', 'FrontTurkishController@contact')->name('pages-tu.contact');   
    Route::get('/faq', 'FrontTurkishController@faq')->name('pages-tu.faq');
    Route::get('/privacy-policy','FrontTurkishController@privacy')->name('pages-tu.privacy');
    Route::get('/terms', 'FrontTurkishController@terms')->name('pages-tu.terms');
});
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', 'AuthController@show')->name('login.show');
    Route::post('login', 'AuthController@login')->name('login');
    Route::get('register', 'AuthController@registerShow')->name('register.show');
    Route::post('register', 'AuthController@register')->name('register');
    Route::get('social', 'AuthController@redirect')->name('auth.social');
    Route::get('callback', 'AuthController@callback')->name('auth.callback');
    Route::get('logout', 'AuthController@logout')->middleware('auth')->name('auth.logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'PagesController@index')->name('dashboard');
    Route::group(['prefix' => 'account'], function () {
        Route::get('/', 'Account\Controller@show')->name('account.show');
        Route::patch('/', 'Account\Controller@update')->name('account.update');
    });
    Route::group(['prefix' => 'investments'], function () {
        Route::get('/', 'Investment\Controller@index')->name('investments.index');
        Route::get('/new', 'Investment\Controller@new')->name('investments.new');
        Route::post('/store', 'Investment\Controller@store')->name('investments.store');
        Route::get('/show/{uuid}', 'Investment\Controller@show')->name('investments.show');
        Route::post('/cancel/{uuid}', 'Investment\Controller@cancel')->name('investments.cancel');
    });
    Route::group(['prefix' => 'maccounts'], function () {
        Route::get('/', 'MAccount\Controller@index')->name('maccounts.index');
        Route::get('/new', 'MAccount\Controller@new')->name('maccounts.new');
        Route::post('/store', 'MAccount\Controller@store')->name('maccounts.store');
        Route::get('/show/{uuid}', 'MAccount\Controller@show')->name('maccounts.show');
        Route::post('/cancel/{uuid}', 'MAccount\Controller@cancel')->name('maccounts.cancel');
    });
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', 'Transaction\Controller@index')->name('transactions.index');
        Route::get('/{uuid}/show', 'Transaction\Controller@show')->name('transactions.show');
        Route::get('deposit', 'Transaction\Controller@deposit')->name('transactions.deposit');
        Route::post('deposit', 'Transaction\Controller@deposited')->name('transactions.deposited');
        Route::get('/{uuid}/transfer', 'Transaction\Controller@transfer')->name('transactions.transfer');
    });
    Route::group(['prefix' => 'activities'], function () {
        Route::get('/', 'Activity\Controller@index')->name('activities.index');
    });
    Route::group(['prefix' => 'call-requests'], function () {
        Route::get('/', 'CallRequest\Controller@index')->name('callRequests.index');
        Route::post('/store', 'CallRequest\Controller@store')->name('callRequests.store');
        Route::get('/cancel/{uuid}', 'CallRequest\Controller@cancel')->name('callRequests.cancel');
    });
    Route::group(['prefix' => 'wallets'], function () {
        Route::get('/', 'Wallet\Controller@index')->name('wallets.index');
        Route::get('/new', 'Wallet\Controller@new')->name('wallets.new');
        Route::post('/', 'Wallet\Controller@store')->name('wallets.store');

        Route::get('/{wallet}/destroy', 'Wallet\Controller@destroy')->name('wallets.destroy');
        Route::get('/{wallet}/status', 'Wallet\Controller@updateStatus')->name('wallets.status.update');
    });
    Route::group(['prefix' => 'withdraws'], function () {
        Route::get('/', 'Withdraw\Controller@index')->name('withdraws.index');
        Route::get('/new', 'Withdraw\Controller@new')->name('withdraws.new');
        Route::post('/store', 'Withdraw\Controller@store')->name('withdraws.store');

        Route::get('/{withdraw}/cancel', 'Withdraw\Controller@cancel')->name('withdraws.cancel');
        Route::get('/{withdraw}/status', 'Withdraw\Controller@updateStatus')
            ->name('withdraws.status.update');
    });

    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'Ticket\Controller@index')->name('tickets.index');
        Route::get('/new', 'Ticket\Controller@new')->name('tickets.new');
        Route::post('/store', 'Ticket\Controller@store')->name('tickets.store');
        Route::get('/show/{uuid}', 'Ticket\Controller@show')->name('tickets.show');
        Route::post('/reply/{uuid}', 'Ticket\Controller@reply')->name('tickets.reply');
        Route::get('/destroy/{uuid}', 'Ticket\Controller@destroy')->name('tickets.destroy');
    });
    Route::get('faqs', 'Controller@faqs')->name('faqs');

    Route::group(['prefix' => 'signals'], function () {
        Route::group(['prefix' => 'analyzers'], function () {
            Route::get('/', 'HodHod\AnalyzerController@index')->name('analyzers.index');
        });
        Route::group(['prefix' => 'subscriptions'], function () {
            Route::get('/', 'HodHod\SubscriptionController@index')->name('subscriptions.index');
        });
    });
});

