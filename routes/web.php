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
    return view('welcome');
});



Auth::routes();

Route::get('/profile','ProfileController@index')->name('profile.index')->middleware('auth');



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostController@index')->name('posts.index');

Route::post('/posts', 'PostController@store')->name('posts.store');

Route::get('/posts/{id}', 'PostController@show')->name('posts.show');

Route::post('/posts/{id}', 'PostController@update')->name('posts.update');


Route::post('/comments', 'CommentController@store')->name('comments.store');

Route::post('/comments/{id}', 'CommentController@update')->name('comments.update');


Route::get('/profile/{id}', 'ProfileController@show')->name('profile.show');

Route::post('/profile', 'ProfileController@store')->name('profile.store');
