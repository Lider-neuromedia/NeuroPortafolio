<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('showcase')->namespace('Api')->middleware('custom-cors')->group(function () {

    Route::get('/', 'ShowcaseController@index');
    Route::get('/categories', 'ShowcaseController@categories');
    Route::get('/categories/{slug}', 'ShowcaseController@category');
    Route::get('/projects/{slug}', 'ShowcaseController@project');

});
