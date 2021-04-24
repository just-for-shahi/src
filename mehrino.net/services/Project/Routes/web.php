<?php


use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'projects', 'middleware'=>"auth:web"], function(){
    Route::get('/', 'PanelController@index')->name('panel.projects');
    Route::get('/create', 'PanelController@create')->name('panel.projects.create');
    Route::post('/store', 'PanelController@store')->name('panel.projects.store');
    Route::get('/{uuid}/destroy', 'PanelController@destroy')->name('panel.projects.destroy');
    Route::get('/{uuid}/show', 'PanelController@show')->name('panel.projects.show');
    Route::post('/{uuid}/updated', 'PanelController@updated')->name('panel.projects.updated');
});
