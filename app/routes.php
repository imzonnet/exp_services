<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::resource('home', 'HomesController');
Route::get('/', function() {
	return Redirect::route('home.index');
});

Route::get('/users/login', ['as' => 'users.login', 'uses'=>'UsersController@login']);
Route::post('/users/login', ['as' => 'users.doLogin', 'uses'=>'UsersController@doLogin']);

Route::resource('users', 'UsersController');