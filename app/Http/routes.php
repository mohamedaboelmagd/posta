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

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
//show all posts
Route::get('index', 'PostController@index');
//form of create post
Route::get('create', 'PostController@create');
//create post
Route::post('create', 'PostController@store');

//create comment
Route::post('create/comment/{id}', 'PostController@comment');
//show comments
Route::get('show/comment/{id}', 'PostController@show');

//show post based on id
Route::get('post/{id}', 'PostController@showPost');