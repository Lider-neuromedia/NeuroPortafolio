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

Route::get('brief/{slug}', 'BriefController@brief')->name('brief.fill');
Route::post('brief/{slug}', 'BriefController@store')->name('brief.save');
Route::post('brief/{slug}/complete', 'BriefController@complete')->name('brief.complete');

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {

    Route::resource('users', 'UsersController', ['except' => ['show']]);

    Route::resource('projects', 'ProjectsController', ['except' => ['show']]);
    Route::resource('categories', 'CategoriesController', ['except' => ['show']]);
    Route::resource('links', 'LinksController', ['only' => ['index', 'destroy']]);
    Route::resource('brief', 'BriefController', ['except' => ['show']]);
    Route::resource('clients', 'ClientsController', ['except' => ['show']]);

    Route::prefix('create-link')->group(function () {

        Route::post('/add/{project}', 'ProjectsController@addProjectToLink')->name('link-creation.add');
        Route::post('/remove/{project}', 'ProjectsController@removeProjectFromLink')->name('link-creation.remove');
        Route::post('/store', 'ProjectsController@createLink')->name('link-creation.store');
        Route::get('/clean', 'ProjectsController@cancelLinkCreation')->name('link-creation.clean');

    });

});

Route::get('cmd-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return response()->json('ok', 200);
});

Route::get('cmd-storage', function () {
    Artisan::call('storage:link');
    return response()->json('ok', 200);
});

Route::get('cmd-db', function () {
    Artisan::call('migrate --seed --no-interaction');
    return response()->json('ok', 200);
});
