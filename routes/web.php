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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/state', 'HomeController@state')->name('state');
Route::post('/bindAddress', 'HomeController@bindAddress')->name('bindAddress');
Route::post('/addTrans', 'HomeController@addTrans');


Route::get('/api/pttidExist', 'ApiController@pttidExist');
// https://fakeptt-freedomtomdestiny.c9users.io/api/pttidExist?pttid={pttid}
// return true:1, false:0
Route::get('/api/checkAddressCoins', 'ApiController@checkAddressCoins');
// https://fakeptt-freedomtomdestiny.c9users.io/api/checkAddressCoins?address={address}
// return true:1, false:0