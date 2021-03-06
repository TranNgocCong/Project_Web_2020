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


// Auth Route
Auth::routes();

//Frontend Controller
Route::get('/allAlbums', 'FrontendController@index');

// Comment Route
Route::resource('comments', 'CommentController');

// Post Route
Route::get('/', 'PostsController@index')->name('post.index');

Route::get('/p/create', 'PostsController@create')->name('post.create');

Route::post('like/{like}', 'LikeController@update2')->name('like.create');

Route::post('/p', 'PostsController@store')->name('post.store');

Route::delete('/p/{post}', 'PostsController@destroy')->name('post.destroy');

Route::get('/p/{post}', 'PostsController@show')->name('post.show');

Route::post('/p/{post}', 'PostsController@updatelikes')->name('post.update'); //  This need more time

Route::get('/explore', 'PostsController@explore')->name('post.explore'); // Explore Page

Route::get('/posts', 'PostsController@vue_index'); // Infinite scrolling

// Profile Route
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

Route::any('/profile/{user}', 'ProfilesController@index')->name('profile.index');

Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::any('/search', 'ProfilesController@search')->name('profile.search'); // Search Page

// Follow Route
Route::post('/follow/{user}', 'FollowsController@store');

// Stories Route
Route::get('/stories/create', 'StoryController@create')->name('stories.create');

Route::get('/stories/{user}', 'StoryController@show')->name('stories.show');

Route::post('/stories', 'StoryController@store')->name('stories.store');

// Albums Route
Route::get('/getalbums', 'AlbumController@getAlbums')->middleware('auth');

Route::get('/albums/create', 'AlbumController@create')->name('album.create')->middleware('auth');

Route::get('/albums', 'AlbumController@index')->middleware('auth');

Route::post('/albums/store', 'AlbumController@store')->middleware('auth');

Route::put('/albums/{id}/edit','AlbumController@update')->middleware('auth');

Route::delete('/albums/{id}/delete','AlbumController@destroy')->middleware('auth');

//Image Route
Route::get('upload/images/{id}', 'GalleryController@create')->middleware('auth');

Route::post('uploadImage', 'GalleryController@upload')->middleware('auth');

Route::get('getimages', 'GalleryController@images')->middleware('auth');

Route::delete('/image/{id}', 'GalleryController@destroy');

Route::get('/albums/{slug}/{id}', 'GalleryController@viewAlbum')->name('view.album');