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
    Route::get('resources', 'PagesController@resources')->name('admin.resources');
    Route::get('resource-board', 'PagesController@board')->name('admin.resource-board');
    Route::get('settings/projects/{type}', 'ProjectController@index')->name('admin.projects');
    Route::get('settings/training', 'PagesController@training')->name('admin.settings.training');
    Route::get('settings/holidays', 'PagesController@holidays')->name('admin.settings.holidays');
    Route::get('settings/titles', 'PagesController@titles')->name('admin.settings.titles');
    Route::get('api/titles', 'TitleController@get');
    Route::get('api/engagements', 'ProjectController@getEngagements');
    Route::get('api/authorised-projects', 'ProjectController@getAuthorisedProjects');

    Route::resource('titles', 'TitleController');

    Route::resource('project', 'ProjectController');
    Route::resource('user', 'UserController');

    Route::get('project/create/{type}', 'ProjectController@create')->name('project.create');
    Route::get('api/resources', 'UserController@getResources')->name('admin.getResources');
});

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');