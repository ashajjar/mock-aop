<?php
/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the Closure to execute when that URI is requested.
 * |
 */
Event::listen('illuminate.query', function ($sql)
{
	Log::info($sql);
});

Route::group(array(
	'prefix' => 'api'
), function ()
{
	Route::get('/users/', 'Controllers\UserController@showAllUsers');
	Route::post('/users/', 'Controllers\UserController@addUser');
	
	Route::get('/', function ()
	{
		return View::make('hello');
	});
});
