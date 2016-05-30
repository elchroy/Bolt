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

Route::get('/', 'PagesController@welcome');

Route::auth();

Route::get('/dashboard', 'PagesController@dashboard');
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


Route::get('categories/add', 'CategoriesController@add');
Route::get('categories', 'CategoriesController@index');
Route::get('categories/{id}', 'CategoriesController@show');
Route::post('categories/create', 'CategoriesController@create');
Route::get('categories/{id}/edit', 'CategoriesController@edit');
Route::patch('categories/{id}', 'CategoriesController@update');
// Route::get('check/{url}', 'VideosController@check')->where()['url' => '/[A-Za-z0-9]+/i'];
// Route::any('check/(.*)', function( $page ){
    // dd($page);
// });

Route::any('check', 'VideosController@check');
