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

//Route::get('/', 'UserHomeController@index');
//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/', 'Controller@redirectIndex');

Auth::routes();
\Illuminate\Support\Facades\Auth::routes();
//Route::impersonate();

//Route::get('/home', 'UserHomeController@index')->name('home');
Route::group(['middleware' => ['web']], function () {

  Route::get('download/{managerId}/{productKeys}', 'Api\LicensingController@prepareArchive');
  // Activation Routes

  Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);
  Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');

  Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
  Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
  Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

  // Socialite Register Routes
  Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
  Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

  // Route to for user to reactivate their user deleted account.
  Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});