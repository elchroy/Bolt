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
	$recent = Bolt\Video::latest()->take(8)->get();
    return view('welcome', compact('recent'));
});

Route::auth();

Route::get('/dashboard', 'DashboardController@index');
Route::get('profile/edit', 'UsersController@edit');
Route::post('profile/update', 'UsersController@update');

// Social Authentication Routes
Route::get('auth/{link}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{link}/callback', 'Auth\AuthController@handleProviderCallback');


// Routes for comments
Route::post('videos/{id}/comments/add', 'CommentsController@createComment');
Route::post('videos/add', 'VideosController@createVideo');
Route::get('videos/add', 'VideosController@add');
Route::get('videos/search', 'VideosController@search');
Route::get('videos/{id}/edit', 'VideosController@edit');
Route::post('videos/{id}/update', 'VideosController@updateVideo');
Route::delete('videos/{id}/delete', 'VideosController@deleteVideo');
Route::post('videos/{id}/favorite', 'VideosController@favorite');
Route::post('videos/{id}/unfavorite', 'VideosController@unfavorite');

Route::get('videos/{id}', 'VideosController@show');
Route::get('videos', 'VideosController@index');
Route::patch('comments/{id}', 'CommentsController@updateComment');
Route::delete('comments/{id}', 'CommentsController@deleteComment');

Route::post('user/changeAvatar', 'UsersController@changeAvatar');
