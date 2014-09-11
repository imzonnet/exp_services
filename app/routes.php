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

Route::group(['before' => 'sentry'], function(){
	Route::get('/users/logout', ['as' => 'users.logout', 'uses'=>'UsersController@logout']);
});

Route::group(['before' => 'sentry|inGroup:user'], function(){
	Route::resource('users', 'UsersController');
});

Route::group(array("before"=>"sentry|inGroup:supporter"), function(){
	Route::resource('supporter', 'SupportersController');
});