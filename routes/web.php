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

Route::get('/', function(){
    return redirect('/login');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function ()
{
    Route::get('resource-board', 'PagesController@board')->name('admin.resource-board');
    Route::get('settings', 'PagesController@settings')->name('admin.settings');
    Route::get('settings/authorised-projects', 'PagesController@authProjects')->name('admin.settings.auth-projects');
    Route::get('settings/training', 'PagesController@training')->name('admin.settings.training');
    Route::get('settings/holidays', 'PagesController@holidays')->name('admin.settings.holidays');
    Route::get('settings/titles', 'PagesController@titles')->name('admin.settings.titles');
    Route::get('api/titles', 'TitleController@get');
    Route::get('api/engagements', 'ProjectController@getEngagements');
    Route::get('api/authprojects', 'ProjectController@getAuthorisedProjects');

    Route::get('project/create', 'ProjectController@create')->name('project.create');
    Route::get('authproject/create', 'ProjectController@createAuth')->name('authproject.create');
    Route::post('project/create', 'ProjectController@store')->name('project.store');

    Route::get('project/edit/{slug}', 'ProjectController@edit')->name('project.edit');

    Route::resource('titles', 'TitleController');
});

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');