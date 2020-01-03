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

Route::get('/', function () {
    return view('app');
});
/*
Route::get('/', 'ChatController@index');
Route::post('/', 'ChatController@join');
Route::get('chat', 'ChatController@chat')->name('chat');
Route::post('logout', 'ChatController@logout')->name('logout');
*/