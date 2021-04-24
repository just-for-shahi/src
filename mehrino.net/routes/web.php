<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', 'WebController@index')->name('index');
Route::middleware(['auth:web'])->get('/dashboard' , 'WebController@dashboard')->name('dashboard');
//Route::get('/', [PagesController::class, 'index'])->name('index');
//Route::get('/about', [PagesController::class, 'about'])->name('about');
//Route::get('/contact', [PagesController::class,'contact'])->name('contact');
//

//
//// Panel Routes
//Route::group(['prefix' => 'my', 'middleware' => 'auth'], function(){
//    Route::get('/', [PanelController::class, 'index'])->name('dashboard');
//    Route::group(['prefix' => 'profile'], function(){
//        Route::get('/', [ProfileController::class, 'show'])->name('profile');
//        Route::post('/', [ProfileController::class, 'update'])->name('profile.update');
//    });
//    Route::group(['prefix' => 'institutes'], function(){
//        Route::get('/', [InstituteController::class, 'index'])->name('institutes');
//        Route::get('/create', [InstituteController::class, 'create'])->name('institutes.create');
//        Route::post('/store', [InstituteController::class, 'store'])->name('institutes.store');
//        Route::get('/{uuid}/show', [InstituteController::class, 'show'])->name('institutes.show');
//        Route::post('/{uuid}/updated', [InstituteController::class, 'updated'])->name('institutes.updated');
//        Route::get('/{uuid}/destroy', [InstituteController::class, 'destroy'])->name('institutes.destroy');
//    });
//});
