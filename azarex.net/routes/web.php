<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
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

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::prefix('pages')->name('pages.')->group(function(){
    Route::get('/about', [PagesController::class, 'about'])->name('about');
    Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
    Route::get('/pricing', [PagesController::class, 'pricing'])->name('pricing');
    Route::get('/privacy', [PagesController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [PagesController::class, 'terms'])->name('terms');
    Route::prefix('help')->name('help.')->group(function(){
        Route::get('/', [PagesController::class, 'index'])->name('index');
    });
    Route::prefix('coins')->name('coins.')->group(function(){
        Route::get('/', [PagesController::class, 'coins'])->name('index');
    });
});
Route::prefix('auth')->name('auth.')->group( function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'verify'])->name('verify');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registered'])->name('registered');
});
Route::middleware(['auth'])->prefix('panel')->name('panel.')->group( function(){
     Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
     Route::prefix('profile')->name('profile.')->group(function(){
         Route::get('/overview', [UserController::class, 'overview'])->name('overview');
         Route::prefix('addresses')->name('addresses.')->group(function(){
             Route::get('/', [AddressController::class, 'index'])->name('index');
             Route::get('/create', [AddressController::class, 'create'])->name('create');
             Route::post('/create', [AddressController::class, 'created'])->name('created');
             Route::delete('/destroy/{uuid}', [AddressController::class, 'destroy'])->name('destroyed');
         });
         Route::prefix('verifications')->name('verifications.')->group(function(){
             Route::get('/', [VerificationController::class, 'index'])->name('index');
         });
     });
     Route::prefix('accounts')->name('accounts.')->group(function(){
         Route::get('/', [AccountController::class, 'index'])->name('index');
         Route::post('/create', [AccountController::class, 'store'])->name('store');
     });
     Route::prefix('wallets')->name('wallets.')->group(function(){
         Route::get('/', [AuthController::class, 'login'])->name('index');
     });
     Route::prefix('transactions')->name('transactions.')->group(function(){
         Route::get('/', [AuthController::class, 'login'])->name('index');
     });
     Route::prefix('tickets')->name('tickets.')->group(function(){
         Route::get('/', [TicketController::class, 'index'])->name('index');
         Route::post('/create', [TicketController::class, 'store'])->name('store');
     });
     Route::prefix('payments')->name('payments.')->group(function(){
         Route::get('/', [AuthController::class, 'login'])->name('index');
     });
     Route::prefix('exchanges')->name('exchanges.')->group(function (){
         Route::get('/', [ExchangeController::class, 'index'])->name('index');
         Route::get('/coins', [ExchangeController::class, 'coins'])->name('coins');
         Route::post('/create', [ExchangeController::class, 'store'])->name('store');
     });
     Route::prefix('bank-accounts')->name('bankAccounts.')->group(function(){
         Route::get('/', [BankAccountController::class, 'index'])->name('index');
         Route::post('/create', [BankAccountController::class, 'store'])->name('store');
     });
     Route::prefix('gateways')->name('gateways.')->group(function(){
         Route::get('/', [AuthController::class, 'login'])->name('index');
     });
     Route::prefix('loans')->name('loans.')->group(function(){
         Route::get('/', [AuthController::class, 'login'])->name('index');
     });
});
