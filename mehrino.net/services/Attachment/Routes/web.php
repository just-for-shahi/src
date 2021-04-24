<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'attachment'], function () {
    Route::get('/test1', 'AttachmentController@test1');
});

Route::group(['prefix' => 'attachment', 'middleware'=>"auth:web"], function(){
    Route::get('/destroy/{uuid}', 'PanelAttachmentController@destroy')->name('panel.attachments.destroy');
});
