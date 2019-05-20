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
Route::middleware(['ativo','auth','verified'])->group(function () {
    Route::get('/','HomeController@index')->name('homeAuth');
    Route::get('/home', 'HomeController@index')->name('user.home');

    // Sócios!
    Route::get('/socios', 'UserController@index')->name('user.index');
    Route::get('/socios/{user}','UserController@show')->name('user.show');
    Route::get('/socios/create', 'UserController@create')->name('user.create');

    Route::post('/socios/create', 'UserController@store')->name('user.store');
    Route::get('/socios/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::put('/socios/{user}/edit', 'UserController@update')->name('user.update');
    Route::delete('/socios/{user}', 'UserController@delete')->name('user.delete');

    // Aeronaves!
    Route::get('/aeronaves', 'AeronaveController@index')->name('aeronaves.index');

    Route::get('/aeronaves/create', 'AeronaveController@create')->name('aeronaves.create');
    Route::post('/aeronaves/create', 'AeronaveController@store')->name('aeronaves.store');
    Route::get('/aeronaves/{aeronave}/edit', 'AeronaveController@edit')->name('aeronaves.edit');
    Route::delete('/aeronaves/{aeronave}', 'AeronaveController@destroy')->name('aeronaves.destroy');
    Route::get('/aeronaves/{aeronave}/pilotos', 'AeronaveController@pilotosIndex')->name('aeronaves.pilotosIndex');
    Route::get('/aeronaves/{aeronave}/pilotos/pilotosNaoAutorizados', 'AeronaveController@pilotosNaoAutorizadosIndex')->name('aeronaves.pilotosNaoAutorizadosIndex'); //nova rota para pilotos nao autorizados
    Route::post('/aeronaves/{aeronave}/pilotos/{piloto}', 'AeronaveController@pilotoAdd')->name('aeronaves.pilotoAdd');
    Route::delete('/aeronaves/{aeronave}/pilotos/{piloto}', 'AeronaveController@pilotoDestroy')->name('aeronaves.pilotoDestroy');
    Route::get('/aeronaves/{aeronave}/precos_tempos', 'AeronaveController@precos_temposIndex')->name('aeronaves.precos_temposIndex');
    
    //Movimentos!
    Route::get('/movimentos', 'MovimentoController@index')->name('movimentos.index');
    Route::get('/movimentos/{movimento}', 'MovimentoController@show')->name('movimentos.show');
    Route::get('/movimentos/{movimento}/edit','MovimentoController@edit')->name('movimentos.edit');
    Route::get('/movimentos/create', 'MovimentoController@create')->name('movimentos.create');
    Route::post('/movimentos', 'MovimentoController@store')->name('movimentos.store');
    Route::put('/movimentos/{movimento}', 'MovimentoController@update')->name('movimentos.update');
    Route::delete('/movimentos/{movimento}', 'MovimentoController@destroy')->name('movimentos.destroy');



    Route::middleware(['direcao'])->group(function () {
        //SOCIOS
        Route::get('/socios/{user}/certificado','UserController@getCertificado')->name('user.certificado')->middleware(['piloto']);
        Route::get('/socios/{user}/licenca','UserController@getLicenca')->name('user.licenca')->middleware(['piloto']);
        Route::patch('/socios/{user}/ativo','UserController@estado')->name('user.ativo');
        Route::patch('/socios/{user}/quota','UserController@quota')->name('user.quota');
    });


});

