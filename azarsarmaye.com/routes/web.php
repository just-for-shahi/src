<?php

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

use Illuminate\Support\Facades\Route;

if (config('app.env') === 'local') {
    Route::get('atest', static function () {
        auth()->login(\App\Models\User::whereRole(6)->firstOrFail());

        return redirect()->route('admin.dashboard');
    });
}

Route::get('/', 'PagesController@index')->name('index');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', 'AuthController@login')->name('login');
    Route::post('/login', 'AuthController@verify')->name('verify');
    Route::get('/register', 'AuthController@register')->name('register');
    Route::post('/register', 'AuthController@registered')->name('registered');
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('social', 'AuthController@redirect')->name('auth.social');
    Route::get('callback', 'AuthController@callback')->name('auth.callback');
});
Route::post('/callRequestStore', 'CallRequestController@store')->name('callRequests.store');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@show')->name('profile.show');
        Route::post('/', 'ProfileController@update')->name('profile.update');
    });
    Route::group(['prefix' => 'accounts'], function () {
        Route::get('/', 'AccountController@index')->name('accounts.index');
        Route::post('/store', 'AccountController@store')->name('accounts.store');
        Route::delete('/{uuid}/destroy', 'AccountController@destroy')->name('accounts.destroy');
        Route::post('/{uuid}/charge', 'AccountController@charge')->name('accounts.charge');
        Route::get('/{uuid}/charging', 'AccountController@charging')->name('accounts.charging');
    });
    Route::group(['prefix' => 'wallets'], function () {
        Route::get('/', 'WalletController@index')->name('wallets.index');
        Route::post('/store', 'WalletController@store')->name('wallets.store');
        Route::delete('/{uuid}/destroy', 'WalletController@destroy')->name('wallets.destroy');
    });
    Route::group(['prefix' => 'bankAccounts'], function () {
        Route::get('/', 'BankAccountController@index')->name('bankAccounts.index');
        Route::post('/store', 'BankAccountController@store')->name('bankAccounts.store');
        Route::delete('/{uuid}/destroy', 'BankAccountController@destroy')->name('bankAccounts.destroy');
    });
    Route::group(['prefix' => 'bankPayments'], function () {
        Route::get('/', 'BankPaymentController@index')->name('bankPayments.index');
        Route::post('/store', 'BankPaymentController@store')->name('bankPayments.store');
        Route::delete('/{uuid}/destroy', 'BankPaymentController@destroy')->name('bankPayments.destroy');
    });
    Route::group(['prefix' => 'investments'], function () {
        Route::get('/', 'InvestmentController@index')->name('investments.index');
        Route::post('/store', 'InvestmentController@store')->name('investments.store');
        Route::delete('/{uuid}/destroy', 'InvestmentController@destroy')->name('investments.destroy');
    });
    Route::group(['prefix' => 'withdraws'], function () {
        Route::get('/', 'WithdrawController@index')->name('withdraws.index');
        Route::post('/store', 'WithdrawController@store')->name('withdraws.store');
        Route::delete('/{uuid}/destroy', 'WithdrawController@destroy')->name('withdraws.destroy');
    });
    Route::get('/activities', 'ActivityController@index')->name('activities');
    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index')->name('tickets.index');
        Route::get('/create', 'TicketController@create')->name('tickets.create');
        Route::post('/store', 'TicketController@store')->name('tickets.store');
        Route::get('/{uuid}/show', 'TicketController@show')->name('tickets.show');
        Route::delete('/{uuid}/destroy', 'TicketController@destroy')->name('tickets.destroy');
        Route::post('/{uuid}/reply', 'TicketController@reply')->name('tickets.reply');
    });
    Route::group(['prefix' => 'callRequests'], function () {
        Route::get('/', 'CallRequestController@index')->name('callRequests.index');
    });
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/', 'TransactionController@index')->name('transactions.index');
        Route::get('/{uuid}/show', 'TransactionController@show')->name('transactions.show');
    });
    Route::group(['prefix' => 'payment'], function () {
        Route::get('/pay/{uuid}', 'TransactionController@payment')->name('payment.pay');
        Route::get('/callback', 'TransactionController@callback')->name('payment.callback');
    });

    Route::middleware('admin')->prefix('admin')->name('admin.')
        ->group(function () {
            Route::get('/dashboard', 'Milad\DashboardController@index')->name('dashboard');
            Route::resources([
                'users' => 'Milad\UserController',
                'accounts' => 'Milad\AccountController',
                'investments' => 'Milad\InvestmentController',
                'transactions' => 'Milad\TransactionController',
                'activities' => 'Milad\ActivityController',
                'call-requests' => 'Milad\CallRequestController',
                'tickets' => 'Milad\TicketController',
//                'ticket-replies' => 'Milad\TicketReplyController',
                'bank-accounts' => 'Milad\BankAccountController', //
                'wallets' => 'Milad\WalletController', //
//            'bank-transfers' => 'Milad\BankTransferController',
                'withdraws' => 'Milad\WithdrawController',
//            'guarantees' => 'Milad\GuaranteeController',
            ]);

            //--- Ticket Replies
            Route::post('/tickets/reply/{ticket}/reply', 'Milad\TicketController@reply')->name('tickets.reply');
            //--- End Of Ticket Replies

            Route::post('/{account}/charge', 'Milad\AccountController@charge')->name('accounts.charge');

            Route::get('/accounts/{account}/accept', 'Milad\AccountController@accept')->name('maccounts.accept');
            Route::post('/withdraws/{withdraw}/accept', 'Milad\WithdrawController@accept')->name('mwithdraws.accept');
            Route::get('/bank-accounts/accept/{bankAccount}', 'Milad\BankAccountController@accept')->name('mbank-accounts.accept');
            Route::get('/wallets/accept/{wallet}', 'Milad\WalletController@accept')->name('wallets.accept');
//        Route::get('/mbank-transfers/accept/{id}', 'Milad\BankTransferController@accept')->name('mbank-transfers.accept');
        });
});
