<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('check', 'UserController@check');
Route::post('getRecords', 'UserController@getRecords');
Route::post('addRegistry', 'UserController@addRegistry');
