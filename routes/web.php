<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::group(['prefix' => 'home'], function(){

    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'activity'], function(){

        Route::get('/', 'ActivityController@create')->name('create');
        Route::post('/store', 'ActivityController@store')->name('store');

    });   
    
    Route::group(['prefix' => 'report'], function(){

        Route::get('/create', 'ReportController@create')->name('create-report');
        Route::post('/store', 'ReportController@store')->name('store-report');
        Route::get('/{token}', 'ReportController@index')->name('report');
        Route::post('/print/{token}', 'ReportController@print')->name('print');

    });    

});

