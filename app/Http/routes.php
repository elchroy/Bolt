<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/dashboard', 'DashboardController@index');

// Social Authentication Routes
Route::get('auth/{link}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{link}/callback', 'Auth\AuthController@handleProviderCallback');


Route::post('videos/add', 'VideosController@createVideo');
Route::get('videos/add', 'VideosController@add');
Route::get('videos/{id}', 'VideosController@show');
Route::get('videos', 'VideosController@index');
