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

Route::get('/', function()
{
	return View::make('hola');
});

Route::get('/admin', array('as' => 'admin', 'uses' => 'indexController@dologin'));
Route::post('/registro', array('as' => 'registro', 'uses' => 'indexController@registro'));
Route::post('/ingresar', array('as' => 'ingresar', 'uses' => 'indexController@login'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'indexController@logout'));

/*
Route::group(array('before' => 'auth', 'prefix' => 'admin'), function(){

	Route::get('/index', array('as' => 'admin.index', 'uses' => 'indexController@index'));
	Route::get('/user', array('as' => 'admin.user', 'uses' => 'UserController@index'));
	Route::get('/user/create', array('as' => 'user.create', 'uses' => 'UserController@create'));
	Route::post('/users/store', array('as' => 'user.store', 'uses' => 'UserController@store'));
	Route::get('/admin/user/{uid}/delete', array('as' => 'user.delete', 'uses' => 'UserController@delete'));
	Route::post('/admin/users/upload', array('as' => 'user.upload', 'uses' => 'UserController@upload'));
});

*/
Route::get('/admin/index', array('as' => 'admin.index', 'uses' => 'indexController@index'));
Route::get('/admin/user', array('as' => 'admin.user', 'uses' => 'UserController@index'));
Route::get('/admin/user/create', array('as' => 'user.create', 'uses' => 'UserController@create'));
Route::post('/admin/users/store', array('as' => 'user.store', 'uses' => 'UserController@store'));
Route::get('/admin/user/{uid}/delete', array('as' => 'user.delete', 'uses' => 'UserController@delete'));
Route::post('/admin/users/upload', array('as' => 'user.upload', 'uses' => 'UserController@upload'));
Route::get('/admin/user/{uid}/edit', array('as' => 'user.edit', 'uses' => 'UserController@edit'));
Route::put('/admin/user/{uid}/update', array('as' => 'user.update', 'uses' => 'UserController@update'));
//Route::get('/admin/notes', array('as' => 'note', 'uses' => 'NoteController@index'));

Route::get('/admin/laura', array('as' => 'laura', 'uses' => 'LauraController@index'));
Route::get('/admin/laura/intro', array('as' => 'laura.intro', 'uses' => 'LauraController@intro'));
