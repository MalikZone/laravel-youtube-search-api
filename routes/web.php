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

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/video-search', 'VideoSearchController@index')->name('video-search');
Route::get('/ajax-even-search', 'VideoSearchController@search')->name('ajax-search');
Route::post('/search', 'VideoSearchController@search')->name('search');

