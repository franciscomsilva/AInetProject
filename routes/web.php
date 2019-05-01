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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/socios', 'UserController@index');
Route::get('/socios/{id}', 'UserController@show');
Route::get('/socios/create', 'UserController@create');
Route::post('/socios/create', 'UserController@create');
Route::get('/socios/{id}/edit', 'UserController@edit');
Route::put('/socios/{id}/edit', 'UserController@edit');
Route::delete('/socios/{id}', 'UserController@delete');
Route::get('/aeronaves', 'AeronaveController@index');