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

// i18n system
Route::get('/locale.json', 'LocaleController@getJSON')->name('localejson');
Route::get('/language/{lang}', 'LocaleController@setLocale')->name('setlocale');

// Scripts generation
Route::get('/team.{username}.sh', 'ScriptController@getTeamScript')->name('script.team');
Route::get('/{username}.sh', 'ScriptController@getUserScript')->name('script.user');

// Static pages
Route::get('/', 'DocumentationController@welcome')->name('welcome');
Route::get('/doc', 'DocumentationController@index')->name('documentation');
Route::get('/privacy', 'DocumentationController@privacy')->name('privacy');
Route::get('/legal', 'DocumentationController@legal')->name('legal');

// Profile pages
Route::get('/u/{username}', 'PublicController@showProfile')->name('profile.user');
Route::get('/t/{teamname}', 'PublicController@showTeam')->name('profile.team');

// Authenticated routes
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified']], function () {
    // Dashboard
    Route::get('/dashboard', 'DashboardController@newDash')->name('dashboard');
    Route::get('/dashboard/{section}', 'DashboardController@dashSection')->name('dashboard.section');
    Route::post('/addkey', 'APIController@addKey')->name('dashboard.addkey');
    Route::get('/edit/{keyid}', 'DashboardController@edit')->name('dashboard.edit');
    Route::post('/edit/{keyid}', 'DashboardController@editPost')->name('dashboard.editpost');
    Route::any('/delete-account', 'Auth\DeleteAccountController@deleteAccount')->name('dashboard.deleteaccount');
    Route::get('/export', 'ExportImportController@export')->name('dashboard.export');
    Route::post('/import', 'ExportImportController@import')->name('dashboard.import');
    Route::any('/delete/{keyid}', 'DashboardController@delete')->name('dashboard.deletepost');
    Route::post('/profile', 'DashboardController@editProfilePost')->name('dashboard.myprofilepost');

    // GitHub integration
    Route::get('/github/login', 'GitHubController@redirectToProvider')->name('github.login');
    Route::get('/github/callback', 'GitHubController@handleProviderCallback')->name('github.callback');
    Route::post('/github/import', 'GitHubController@importGitHubKeys')->name('github.post');

    // Teams
    Route::get('/team/create', 'TeamController@createTeam')->name('team.create');
    Route::post('/team/create', 'TeamController@createTeamPost')->name('team.create.post');

    Route::get('/team/admin/{teamid}', 'TeamController@adminTeam')->name('team.admin');
    Route::post('/team/admin/{teamid}', 'TeamController@adminTeamPost')->name('team.admin.post');
    Route::get('/team/admin/{teamid}/kickmember/{userid}', 'TeamController@kickMember')->name('team.admin.kick');

    Route::post('/team/admin/{teamid}/addmember', 'TeamController@addMember')->name('team.admin.add');
    Route::get('/team/invitation/{invitationid}/accept', 'TeamController@acceptInvitation')->name('team.invitation.accept');
    Route::get('/team/invitation/{invitationid}/ignore', 'TeamController@ignoreInvitation')->name('team.invitation.ignore');

    Route::get('/team/delete/{teamid}', 'TeamController@deleteTeam')->name('team.delete');
});


