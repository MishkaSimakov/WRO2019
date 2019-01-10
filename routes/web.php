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

Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
Route::get('/posts', 'PostController@index')->name('posts');

Route::get('/channels/{channel}', 'ChannelController@show')->name('channels.show');
Route::get('/channels/{channel}/edit', 'ChannelController@update')->name('channels.edit');