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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::any('/delete-account', 'Auth\DeleteAccountController@deleteAccount')->name('deleteaccount');

Route::get('/export', 'ExportImportController@export')->name('export');

Route::post('/import', 'ExportImportController@import')->name('import');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('verified');

Route::post('/addkey', 'APIController@addKey')->name('addkey')->middleware('verified');

Route::get('/dashboard/apps', 'DashboardController@apps')->name('dashboardapps')->middleware('verified');

Route::get('/my-profile', 'DashboardController@editProfile')->name('myprofile')->middleware('verified');

Route::post('/my-profile', 'DashboardController@editProfilePost')->name('myprofilepost')->middleware('verified');

Route::get('/doc', 'DocumentationController@index')->name('documentation');

Route::get('/privacy', 'DocumentationController@privacy')->name('privacy');

Route::get('/edit/{keyid}', 'DashboardController@edit')->name('edit');

Route::post('/edit/{keyid}', 'DashboardController@editPost')->name('editpost');

Route::any('/delete/{keyid}', 'DashboardController@delete')->name('deletepost');

Route::get('/u/{username}', 'PublicController@showProfile')->name('profile');
