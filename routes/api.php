<?php

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

Route::middleware('auth:api')->get('/user', 'APIController@getUser');

Route::get('/user/{userid}', 'APIController@getUser');

Route::get('/user/match/{query}', 'APIController@getUserByQuery');

Route::middleware(['auth:api', 'scopes:keys'])->post('/keys/add', 'APIController@addKey')->name('keyadd');

Route::get('/keys/{keyid}', 'APIController@getKey')->name('keyget');

Route::middleware(['auth:api', 'scopes:keys'])->put('/keys/{keyid}', 'APIController@editKey')->name('keyedit');

Route::middleware(['auth:api', 'scopes:keys'])->delete('/keys/{keyid}', 'APIController@deleteKey')->name('keydelete');

Route::post('/keys/fetch', 'APIController@fetchKey')->name('keyfetch');
