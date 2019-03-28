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

Route::middleware('auth:api')->get('/user', 'APIController@getUser')->name('api.user.self');
Route::get('/user/{userid}', 'APIController@getUser')->name('api.user.get');
Route::get('/user/match/{query}', 'APIController@getUserByQuery')->name('api.user.query');

Route::middleware(['auth:api', 'scopes:keys'])->post('/keys/add', 'APIController@addKey')->name('api.key.add');

Route::get('/keys/{keyid}', 'APIController@getKey')->name('api.key.get');
Route::middleware(['auth:api', 'scopes:keys'])->put('/keys/{keyid}', 'APIController@editKey')->name('api.key.edit');
Route::middleware(['auth:api', 'scopes:keys'])->delete('/keys/{keyid}', 'APIController@deleteKey')->name('api.key.delete');

Route::post('/keys/fetch', 'APIController@fetchKey')->name('api.key.fetch');

Route::get('/team/{teamid}', 'APIController@getTeam')->name('api.team.get');
Route::get('/team/match/{query}', 'APIController@getTeamByQuery')->name('api.team.query');
