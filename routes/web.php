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

Route::get('', 'WelcomeController@index');

//crate archive
Route::get('/create', 'CurrentController@index')->name('create')->middleware('auth');
Route::post('currents/create', 'CurrentController@create')->name('currents.create');

//posts
Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
Route::get('/posts', 'PostController@index')->name('posts');
Route::post('/posts/create', 'PostController@create')->name('posts.create');


//channels
Route::get('/channels/{channel}', 'ChannelController@show')->name('channels.show');
Route::get('/channels/{channel}/edit', 'ChannelController@update')->name('channels.edit');
Route::post('/channels/create', 'ChannelController@create')->name('channels.create');


//statuses
Route::get('/statuses/{status}', 'StatusController@show')->name('statuses.show')->middleware('auth');;
Route::get('/statuses/{status}/edit', 'StatusController@update')->name('statuses.edit')->middleware('auth');;
Route::post('/statuses/create', 'StatusController@create')->name('statuses.create');


//sensors
Route::post('/sensors/create', 'SensorController@create')->name('sensors.create');

Auth::routes();