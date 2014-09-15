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
});

Route::group(['before' => 'sentry|inGroup:user', 'prefix' => 'users'], function(){
	//Route::controller('users', 'UsersController');
	Route::get('index', ['as' => 'users.index', 'uses' => 'UsersController@getIndex']);
	
	Route::get('items', ['uses' => 'UsersController@getItems']);
	Route::get('items/index', ['as' => 'items.index', 'uses' => 'UsersController@getItems']);
	Route::get('items/{id}', ['as' => 'items.show', 'uses' => 'UsersController@getItemsShow'])->where('id','[0-9]+');
});

Route::group(array("before"=>"sentry|inGroup:supporter"), function(){
	Route::controller('supporters', 'SupportersController');
});


/*
Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});
