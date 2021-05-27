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
Route::get('/reset', function () {
    return view('resetpassword');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/set', 'UserController@setpassword')->name('setpass');
Route::post('resetpassword', 'UserController@resetpassword')->name('resetpassword');


//Route untuk chat
Route::get('/ask', 'ChatController@index')->name('chat')->middleware('auth');;
Route::get('/message/{id}', 'ChatController@getMessage')->name('message')->middleware('auth');;
Route::post('message', 'ChatController@sendMessage')->middleware('auth');;
