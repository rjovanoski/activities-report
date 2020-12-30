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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/activity', 'ActivityController@create')->name('create');
Route::post('/home/activity/store', 'ActivityController@store')->name('store');

Route::get('/home/report/create', 'ReportController@create')->name('create-report');
Route::post('/home/report/store', 'ReportController@store')->name('store-report');
Route::get('/home/report/{token}', 'ReportController@index')->name('report');
Route::post('home/report/print/{token}', 'ReportController@print')->name('print');