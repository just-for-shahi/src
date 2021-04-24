<?php

use Illuminate\Support\Facades\Route;

#region report
Route::group(['prefix' => '/{service}/{uuid}/report', 'middleware' => 'auth:web'], function () {
    Route::get('/list', 'PanelController@index')->name('panel.report.list');
    Route::get('/', 'PanelController@create');
    Route::post('/', 'PanelController@store')->name('panel.report.create');

    Route::get('/{id}', 'PanelController@show')->name('panel.report.show');
    Route::post('/{id}', 'PanelController@updated')->name('panel.report.updated');
    Route::get('/{id}/destroy', 'PanelController@updated')->name('panel.report.destroy');
});
