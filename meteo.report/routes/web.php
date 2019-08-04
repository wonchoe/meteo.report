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
    if (Auth::guest()) {
        return view('auth.login');
    } else {
        return view('welcome');
    }
});

Route::get('admin/editor', 'Admin\EditorController@show')->middleware('auth');
Route::post('admin/editor/code/get', 'Admin\EditorController@getCode')->middleware('auth');
Route::post('admin/editor/code/set', 'Admin\EditorController@setCode')->middleware('auth');

Route::get('admin', 'Admin\DashboardController@show')->middleware('auth');

Route::get('admin/install', 'TraficController@show')->middleware('auth');
Route::post('admin/install', 'TraficController@archive')->middleware('auth');
Route::get('admin/install/archived', 'TraficController@showArchived')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tdstraf/{ip}/{site_id}/{installed}','TraficController@index');