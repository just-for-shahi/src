<?php
use Illuminate\Support\Facades\Route;
//// Authentication
Route::prefix('auth')->group(function(){
    Route::get('/login', 'WebController@login')->name('login');
    Route::post('/login', 'WebController@verify')->name('verify');
    Route::post('/verify', 'WebController@verified')->name('verified');
    Route::get('/register', 'WebController@register')->name('register');
    Route::post('/logout', 'WebController@logout')->name('logout');
    // Route::get('/social', 'WebController@redirect')->name('social.redirect');
    // Route::get('/callback', 'WebController@callback')->name('social.callback');
});

Route::middleware(['auth:web'])->prefix('dashboard')->group(function () {
    Route::get('profile' , 'ProfileController@index')->name('profile');
    Route::put('profile/update' , 'ProfileController@update')->name('profile.update');
});

Route::middleware(['auth:web'])->prefix('panel/users')->name('panel.')->group(function () {
    Route::get('/', 'PanelController@index')->name('users');
    Route::get('/create', 'PanelController@create')->name('users.create');
    Route::post('/store', 'PanelController@store')->name('users.store');
    Route::get('/{uuid}/destroy', 'PanelController@destroy')->name('users.destroy');
    Route::get('/{uuid}/show', 'PanelController@show')->name('users.show');
    Route::get('/profile/{uuid}', 'PanelController@profile')->name('users.profile');
    Route::post('/{uuid}/updated', 'PanelController@updated')->name('users.updated');
});
