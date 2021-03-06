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

//posts
Route::get('/posts/adding', 'PostController@adding')->name('posts.adding')->middleware('auth');
Route::post('/posts/confirm', 'PostController@confirm')->name('posts.confirm')->middleware('auth');

Route::post('admin/untrusted_post/adding', 'PostController@add_untrusted')->name('admin.add_untrusted')->middleware('admin');

Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');

Route::get('/posts', 'PostController@index')->name('posts');

//channels
Route::get('/channels/periodicity', 'ChannelController@getPeriodicity');
Route::get('/channels/{channel}', 'ChannelController@show')->name('channels.show');
Route::get('/channels/{channel}/edit', 'ChannelController@update')->name('channels.edit');


//statuses
Route::get('/statuses/{status}', 'StatusController@show')->name('statuses.show')->middleware('auth');
Route::get('/statuses/{status}/edit', 'StatusController@update')->name('statuses.edit')->middleware('auth');

Route::post('/upload', 'CurrentController@upload')->name('upload');

Route::get('/date', 'CurrentController@date');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/load', 'PostController@load')->name('data.load');
Route::get('/chart', 'ChannelController@getChart')->name('channels.chart');
Route::get('/search', 'WelcomeController@search')->name('search');

Auth::routes();