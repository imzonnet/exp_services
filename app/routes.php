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

Route::get('/items/create', ['as' => 'items.create', 'uses'=>'ItemsController@create']);
Route::post('/items/store', ['as' => 'items.store', 'uses'=>'ItemsController@store']);

Route::group(['before' => 'sentry'], function(){

	Route::get('/users/logout', ['as' => 'users.logout', 'uses'=>'UsersController@logout']);

	Route::get('items/index', ['as' => 'items.list', 'uses' => 'ItemsController@index']);
	Route::get('items/{id}', ['as' => 'items.show', 'uses' => 'ItemsController@show'])->where('id','[0-9]+');
	
	Route::post('items/{id}', 'ItemsController@postMessages');

});

Route::group(['before' => 'sentry|inGroup:user', 'prefix' => 'users'], function(){
	Route::get('index', ['as' => 'users.index', 'uses' => 'UsersController@getIndex']);
});

Route::group(array("before"=>"sentry|inGroup:supporter", 'prefix' => 'supporters'), function(){
	Route::get('index', ['as' => 'supporters.index', 'uses' => 'SupportersController@getIndex']);
});


/*
Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});
