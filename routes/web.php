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

    Route::get('project/create/{type}', 'ProjectController@create')->name('project.create');
    Route::post('project/create', 'ProjectController@store')->name('project.store');
    Route::get('project/edit/{ecode}', 'ProjectController@edit')->name('project.edit');
    Route::post('project/edit/{id}', 'ProjectController@update')->name('project.update');
    Route::delete('project/{id}', 'ProjectController@destroy')->name('project.delete');

    Route::get('user/create', 'UserController@create')->name('user.create');
    Route::post('user/create', 'UserController@store')->name('user.store');
    Route::get('user/edit/{slug}', 'UserController@edit')->name('user.edit');
    Route::post('user/edit/{id}', 'UserController@update')->name('user.update');
    Route::delete('user/{id}', 'UserController@destroy')->name('user.delete');
    Route::get('api/resources', 'UserController@getResources')->name('admin.getResources');
});

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');