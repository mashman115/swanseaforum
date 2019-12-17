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


//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/posts', 'PostController@index')->name('posts.index');

Route::post('/posts', 'PostController@store')->name('posts.store');


Route::get('/posts/{id}', 'PostController@show')->name('posts.show')->middleware('auth');

Route::delete('/posts/{id}', 'PostController@destroy')->name('posts.destroy');

Route::post('/posts/{id}', 'PostController@update')->name('posts.update');


Route::post('/comments', 'CommentController@store')->name('comments.store');

Route::post('/comments/{id}', 'CommentController@update')->name('comments.update');

Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comments.destroy');

Route::post('/profile', 'ProfileController@store')->name('profile.store')->middleware('auth');

Route::get('/profile/{id}', 'ProfileController@show')->name('profile.show');

Route::group(['middleware' => ['auth', 'is.admin']], function() {
  Route::get('/admin', 'ProfileController@isAdmin')->name('profile.showAdmin')->middleware('is.admin');
});

use App\NewsApi;
app()->singleton('App\NewsApi', function($app){
  return new NewsApi('https://newsapi.org/v2/top-headlines?sources=','bbc-news&','apiKey=658f5779a0f1484e8bae58d44ed3ee67');
});

Route::get('NewsApi','NewsApiController@index')->name('newsapi.index');
