<?php
use Illuminate\Support\Facades\Route;
  #region post
  Route::middleware(['auth:web','can:admin'])->prefix('dashboard/post')->group(function () {
    Route::get('/', 'WebController@index')->name('post.index');
    Route::get('/create' , 'WebController@create')->name('post.create');
    Route::post('/', 'WebController@store')->name('post.store');
//    Route::get('/{uuid}', 'WebController@show')->name('post.show');
    Route::get('/{uuid}/edit', 'WebController@edit')->name('post.edit');
    Route::put('/{uuid}/update', 'WebController@update')->name('post.update');
    Route::delete('/{uuid}/destroy', 'WebController@destroy')->name('post.destroy');
});
#endregion
