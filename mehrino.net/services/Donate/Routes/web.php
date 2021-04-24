<?php
use Illuminate\Support\Facades\Route;

Route::get('/donate', 'WebController@show')->name('donate');
Route::post('/donate', 'WebController@store')->name('donate.store');
