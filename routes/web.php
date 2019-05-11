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

Auth::routes(['verify' => true,'register' => false]);


//GRUPO DE MIDDLEWARE PARA QUE TODAS ESTAS ROTAS SEJAM NECESSARIO ESTAR AUTENTICADO
Route::middleware(['ativo'],['auth'],['verified'])->group(function () {
    Route::get('/','HomeController@index')->name('homeAuth');
    Route::get('/home', 'HomeController@index')->name('user.home');

    // Sócios!
    Route::get('/socios', 'UserController@index')->name('user.index');
    Route::get('/socios/create', 'UserController@create')->name('user.create');
    Route::post('/socios/create', 'UserController@store')->name('user.store');
    Route::get('/socios/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::put('/socios/{user}/edit', 'UserController@update')->name('user.update');
    Route::delete('/socios/{user}', 'UserController@delete')->name('user.delete');

    // Aeronaves!
    Route::get('/aeronaves', 'AeronaveController@index')->name('aeronaves.index');
    Route::get('/aeronaves/create', 'AeronaveController@create')->name('aeronaves.create');   // criar aeronave
    Route::post('/aeronaves/create', 'AeronaveController@store')->name('aeronaves.store');
    Route::get('/aeronaves/{aeronave}/edit', 'AeronaveController@edit')->name('aeronaves.edit'); // editar aeronave
    Route::delete('/aeronaves/{aeronave}', 'AeronaveController@destroy')->name('aeronaves.destroy'); // eliminar aeronave


    //Movimentos!
    Route::get('/movimentos', 'MovimentoController@index')->name('movimentos.index');
    Route::get('/movimentos/{movimento}', 'MovimentoController@show')->name('movimentos.show');
    Route::get('/movimentos/{movimento}/edit','MovimentoController@edit')->name('movimentos.edit');
    Route::get('/movimentos/create', 'MovimentoController@create')->name('movimentos.create');
    Route::post('/movimentos', 'MovimentoController@store')->name('movimentos.store');
    Route::put('/movimentos/{movimento}', 'MovimentoController@update')->name('movimentos.update');
    Route::delete('/movimentos/{movimento}', 'MovimentoController@destroy')->name('movimentos.destroy');
});

