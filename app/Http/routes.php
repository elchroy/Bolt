<?php

// All the ID parameters will accept only recieve integer patterns.
// All other patterns will return to an unfriendly 404 response.

Route::get('/', 'PagesController@welcome');

Route::post('/stored_json', 'JsonController@storeJson');
Route::get('/stored_json', 'JsonController@getStoredJson');

Route::auth();

// Rser Dashboard Route
Route::get('/dashboard', 'PagesController@dashboard');

// User change avatar
Route::post('user/changeAvatar', 'UsersController@changeAvatar');

// User edit profile
Route::get('profile/edit', 'UsersController@edit');
Route::post('profile/update', 'UsersController@update');

// Social Authentication Routes
Route::get('auth/{link}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{link}/callback', 'Auth\AuthController@handleProviderCallback');

Route::any('check', 'VideosController@check');

// Video Routes
Route::group(['prefix' => 'videos'], function () {

    // View a collection of videos.
    Route::get('', 'VideosController@index');

    // Add a video
    Route::post('/add', 'VideosController@createVideo');
    Route::get('/add', 'VideosController@add');

    //Search for a video
    Route::get('/search', 'VideosController@search');

    Route::group(['prefix' => '/{id}'], function () {
        // Post a comment to a video
        Route::post('/comments/add', 'CommentsController@createComment');

        // Edit a video
        Route::get('/edit', 'VideosController@edit');
        Route::post('/update', 'VideosController@updateVideo');

        // Delete a video
        Route::delete('/delete', 'VideosController@deleteVideo');

        // Favorite a video
        Route::post('/favorite', 'VideosController@favorite');

        // Unfavorite a video
        Route::post('/unfavorite', 'VideosController@unfavorite');

        // Visit/Watch a video.
        Route::get('', 'VideosController@show');
    });
});

// Comment Routes
Route::group(['prefix' => 'comments/{id}'], function () {
    Route::patch('', 'CommentsController@updateComment');
    Route::delete('', 'CommentsController@deleteComment');
});

//Category Routes
Route::group(['prefix' => 'categories'], function () {

    // Show all categories
    Route::get('', 'CategoriesController@index');

    // Add a category
    Route::get('add', 'CategoriesController@add');
    Route::post('create', 'CategoriesController@create');

    Route::group(['prefix' => '/{id}'], function () {

        // Show a cateory and the vides under it.
        Route::get('', 'CategoriesController@show');

        // Edit a category
        Route::get('/edit', 'CategoriesController@edit');
        Route::patch('', 'CategoriesController@update');
    });
});
