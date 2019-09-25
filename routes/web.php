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
    Route::get('settings/authorised-projects', 'PagesController@authProjects')->name('admin.auth-projects');
    Route::get('settings/training', 'PagesController@training')->name('admin.training');
    Route::get('settings/holidays', 'PagesController@holidays')->name('admin.holidays');
    Route::get('settings/titles', 'PagesController@titles')->name('admin.titles');
    Route::get('api/titles', 'TitleController@get');

    Route::resource('titles', 'TitleController');

    Route::resource('projects', 'ProjectController');
});



Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');