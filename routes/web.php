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

Route::get('list', 'ListController@index');     // get all items route
Route::post('list', 'ListController@create');   // create route
Route::post('delete', 'ListController@delete'); // delte route
Route::post('update', 'ListController@update'); // update route

// search route
Route::get('search', 'ListController@search');
