<?php
Auth::routes();

/*
 * Posts
 */
Route::get('/posts/novo', 'PostsController@novo');
Route::post('/posts/store', 'PostsController@store')->name('posts.store');
Route::get('/post/publish/${id}', 'PostsController@publish')->name('posts.publish');
Route::get('/posts/${id}', 'PostsController@show')->name('posts.show');
Route::get('/posts/${id}/edit', 'PostsController@edit')->name('posts.edit');
Route::put('/posts/${id}', 'PostsController@update')->name('posts.update');
Route::delete('/posts/${id}', 'PostsController@destroy')->name('posts.destroy');

/*
 * Home
 */
Route::get('/home', 'HomeController@index')->name('home');

/*
 * Public
 */
Route::get('/postagem/', 'PublicController@postagem');
Route::get('/', 'PublicController@index');

