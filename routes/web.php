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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('showcase/{link}', 'ProjectsController@index');
Route::get('project/{project}', 'ProjectsController@show');

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {

    Route::resource('users', 'UsersController', ['except' => ['show']]);

    Route::resource('projects', 'ProjectsController', ['except' => ['show']]);
    Route::resource('categories', 'CategoriesController', ['except' => ['show']]);
    Route::resource('links', 'LinksController', ['only' => ['index', 'destroy']]);

    Route::prefix('create-link')->group(function () {

        Route::post('/add/{project}', 'ProjectsController@addProjectToLink')->name('link-creation.add');
        Route::post('/remove/{project}', 'ProjectsController@removeProjectFromLink')->name('link-creation.remove');
        Route::post('/store', 'ProjectsController@createLink')->name('link-creation.store');
        Route::get('/clean', 'ProjectsController@cancelLinkCreation')->name('link-creation.clean');

    });

});
