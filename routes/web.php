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
Route::get('showcase/{link}/{project}', 'ProjectsController@show');

Route::get('brief/{slug}', 'BriefController@brief')->name('brief.fill');
Route::post('brief/{slug}', 'BriefController@store')->name('brief.save');
Route::post('brief/{slug}/complete', 'BriefController@complete')->name('brief.complete');

Route::middleware('auth')->group(function () {

    Route::get('project/{project}', 'ProjectsController@project')->name('project.show');

});

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function () {

    Route::middleware('role:admin')->resource('users', 'UsersController', ['except' => ['show']]);

    Route::middleware('role:admin')->resource('projects', 'ProjectsController', ['except' => ['index', 'show']]);
    Route::middleware('role:viewer')->get('/projects', 'ProjectsController@index')->name('projects.index');

    Route::middleware('role:admin')->resource('categories', 'CategoriesController', ['except' => ['index', 'show']]);
    Route::middleware('role:viewer')->get('/categories', 'CategoriesController@index')->name('categories.index');

    Route::middleware('role:admin')->resource('links', 'LinksController', ['only' => ['destroy']]);
    Route::middleware('role:admin')->post('brief/{brief}/duplicate', 'BriefController@duplicate')->name('brief.duplicate');
    Route::middleware('role:viewer')->get('/links', 'LinksController@index')->name('links.index');

    Route::middleware('role:admin')->resource('brief', 'BriefController', ['except' => ['index', 'show']]);
    Route::middleware('role:viewer')->get('/brief', 'BriefController@index')->name('brief.index');

    Route::middleware('role:admin')->resource('clients', 'ClientsController', ['except' => ['index', 'show']]);
    Route::middleware('role:viewer')->get('/clients', 'ClientsController@index')->name('clients.index');

    Route::middleware('role:admin')->resource('brief-assign', 'BriefAssignController', ['except' => ['index', 'create', 'edit', 'show']]);
    Route::middleware('role:viewer')->get('/brief-assign', 'BriefAssignController@index')->name('brief-assign.index');
    Route::middleware('role:viewer')->get('/brief-assign/{brief_assign}', 'BriefAssignController@show')->name('brief-assign.show');

    Route::middleware('role:admin')->prefix('create-link')->group(function () {

        Route::post('/add/{project}', 'ProjectsController@addProjectToLink')->name('link-creation.add');
        Route::post('/remove/{project}', 'ProjectsController@removeProjectFromLink')->name('link-creation.remove');
        Route::post('/store', 'ProjectsController@createLink')->name('link-creation.store');
        Route::get('/clean', 'ProjectsController@cancelLinkCreation')->name('link-creation.clean');

    });

    Route::middleware('role:viewer')->prefix('charts')->group(function () {
        Route::get('monthly', function () {
            return view('admin.charts.monthly');
        })->name('charts.monthly');
        Route::get('events', function () {
            return view('admin.charts.events');
        })->name('charts.events');
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
