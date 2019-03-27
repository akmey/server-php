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

Route::get('/', 'DocumentationController@welcome')->name('welcome');

Auth::routes(['verify' => true]);

Route::any('/delete-account', 'Auth\DeleteAccountController@deleteAccount')->name('deleteaccount');

Route::get('/export', 'ExportImportController@export')->name('export');

Route::post('/import', 'ExportImportController@import')->name('import');

Route::get('/dashboard', 'DashboardController@newDash')->name('dashboard')->middleware('verified');

Route::get('/dashboard/{section}', 'DashboardController@dashSection')->name('dashboardsection')->middleware('verified');

Route::post('/addkey', 'APIController@addKey')->name('addkey')->middleware('verified');

Route::post('/profile', 'DashboardController@editProfilePost')->name('myprofilepost')->middleware('verified');

Route::get('/doc', 'DocumentationController@index')->name('documentation');

Route::get('/privacy', 'DocumentationController@privacy')->name('privacy');

Route::get('/legal', 'DocumentationController@legal')->name('legal');

Route::get('/edit/{keyid}', 'DashboardController@edit')->name('edit');

Route::post('/edit/{keyid}', 'DashboardController@editPost')->name('editpost');

Route::any('/delete/{keyid}', 'DashboardController@delete')->name('deletepost');

Route::get('/u/{username}', 'PublicController@showProfile')->name('profile');

Route::get('/t/{teamname}', 'PublicController@showTeam')->name('team');

Route::get('/github/login', 'GitHubController@redirectToProvider')->name('githublogin')->middleware('verified');

Route::get('/github/callback', 'GitHubController@handleProviderCallback')->name('githubcallback')->middleware('verified');

Route::post('/github/import', 'GitHubController@importGitHubKeys')->name('githubpost')->middleware('verified');

Route::get('/locale.json', 'LocaleController@getJSON')->name('localejson');

Route::get('/language/{lang}', 'LocaleController@setLocale')->name('setlocale');

Route::get('/team.{username}.sh', 'ScriptController@getTeamScript')->name('teamscript');

Route::get('/{username}.sh', 'ScriptController@getUserScript')->name('userscript');

Route::get('/team/create', 'TeamController@createTeam')->name('teamcreate');

Route::post('/team/create', 'TeamController@createTeamPost')->name('teamcreatepost');

Route::get('/team/admin/{teamid}', 'TeamController@adminTeam')->name('teamadmin');

Route::post('/team/admin/{teamid}', 'TeamController@adminTeamPost')->name('teamadminpost');

Route::post('/team/admin/{teamid}/addmember', 'TeamController@addMember')->name('teamadminadd');

Route::get('/team/admin/{teamid}/kickmember/{userid}', 'TeamController@kickMember')->name('teamadminkick');

Route::get('/team/invitation/{invitationid}/accept', 'TeamController@acceptInvitation')->name('teaminvitationaccept');

Route::get('/team/invitation/{invitationid}/ignore', 'TeamController@ignoreInvitation')->name('teaminvitationignore');

Route::get('/team/delete/{teamid}', 'TeamController@deleteTeam')->name('teamdelete');
