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

Auth::routes();

Route::any('/delete-account', 'Auth\DeleteAccountController@deleteAccount')->name('deleteaccount');

Route::get('/export', 'ExportImportController@export')->name('export');

Route::post('/import', 'ExportImportController@import')->name('import');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/dashboard/apps', 'DashboardController@apps')->name('dashboardapps');

Route::get('/doc', 'DocumentationController@index')->name('documentation');

Route::get('/edit/{keyid}', 'DashboardController@edit')->name('edit');

Route::post('/edit/{keyid}', 'DashboardController@editPost')->name('editpost');

Route::any('/delete/{keyid}', 'DashboardController@delete')->name('deletepost');
