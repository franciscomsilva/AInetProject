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

    Route::get('/password','UserController@password')->name('user.password');
    Route::patch('/password','UserController@updatePassword')->name('user.updatePassword');


    //ROTAS PROTEGIDAS COM A VERIFICACAO DA PASSWORD INICAL
    Route::middleware(['passwordInicial'])->group(function () {
        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index')->name('user.home');


        #REGION DIRECAO
        Route::middleware(['direcao'])->group(function () {
            #region socios
            Route::patch('/socios/reset_quotas', 'UserController@resetQuotas')->name('user.resetQuotas');
            Route::patch('/socios/desativar_sem_quotas', 'UserController@desativarSQuotas')->name('user.desativarSQuotas');
            Route::delete('/socios/{user}', 'UserController@destroy')->name('user.destroy');
            Route::get('/socios/create', 'UserController@create')->name('user.create');
            Route::patch('/socios/{user}/ativo', 'UserController@estado')->name('user.ativo');
            Route::patch('/socios/{user}/quota', 'UserController@quota')->name('user.quota');
            Route::post('/socios/{user}/send_reactivate_mail', 'UserController@reenviarEmail')->name('user.email');
            #endregion socios

            Route::get('/pendentes','MovimentoController@pendentes')->name('movimentos.pendentes');


        });
        #ENDREGION DIRECAO

        // Sócios!
        #region socios
        Route::get('/socios', 'UserController@index')->name('user.index');
        Route::post('/socios', 'UserController@store')->name('user.store');
        Route::get('/socios/{user}', 'UserController@show')->name('user.show');
        Route::get('/socios/{user}/certificado', 'UserController@getCertificado')->name('user.certificado')->middleware(['piloto']);
        Route::get('/socios/{user}/licenca', 'UserController@getLicenca')->name('user.licenca')->middleware(['piloto']);

        Route::get('/socios/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::put('/socios/{user}/edit', 'UserController@update')->name('user.update');
        #endregion socios

        // Aeronaves!
        #region aeronaves
        Route::get('/aeronaves', 'AeronaveController@index')->name('aeronaves.index');

        Route::get('/aeronaves/create', 'AeronaveController@create')->name('aeronaves.create');
        Route::post('/aeronaves/create', 'AeronaveController@store')->name('aeronaves.store');
        Route::get('/aeronaves/{aeronave}/edit', 'AeronaveController@edit')->name('aeronaves.edit');
        Route::put('/aeronaves/{aeronave}', 'AeronaveController@update')->name('aeronaves.update');
        Route::delete('/aeronaves/{aeronave}', 'AeronaveController@destroy')->name('aeronaves.destroy');

        Route::get('/aeronaves/{aeronave}/pilotos', 'AeronaveController@pilotosIndex')->name('aeronaves.pilotosIndex');
        Route::get('/aeronaves/{aeronave}/pilotos/nao-autorizados', 'AeronaveController@pilotosNaoAutorizadosIndex')->name('aeronaves.pilotosNaoAutorizadosIndex');
        Route::post('/aeronaves/{aeronave}/pilotos/{piloto}', 'AeronaveController@autorizarPiloto')->name('aeronaves.autorizarPiloto');
        Route::delete('/aeronaves/{aeronave}/pilotos/{piloto}', 'AeronaveController@removerPiloto')->name('aeronaves.removerPiloto');
        Route::get('/aeronaves/{aeronave}/precos_tempos', 'AeronaveController@precos_temposJSON')->name('aeronaves.precos_temposJSON');
        Route::get('/aeronaves/{aeronave}/precos', 'AeronaveController@precos_temposIndex')->name('aeronaves.precos_temposIndex');
    
        #endregion aeronaves

        //Movimentos!
        #region movimentos
        Route::get('/movimentos', 'MovimentoController@index')->name('movimentos.index');
        Route::get('/movimentos/estatisticas', 'EstatisticasController@estatisticas')->name('movimentos.estatisticas');
        Route::post('movimentos/estatisticas', 'EstatisticasController@getEstatisticas')->name('movimentos.getEstatisticas');

        //SO PERMITE SE FOR DIRECAO E/OU PILOTO
        Route::middleware(['direcao','piloto'])->group(function () {
            Route::get('/movimentos/create', 'MovimentoController@create')->name('movimentos.create');
            Route::get('/movimentos/{movimento}', 'MovimentoController@show')->name('movimentos.show');
            Route::get('/movimentos/{movimento}/edit', 'MovimentoController@edit')->name('movimentos.edit');
            Route::post('/movimentos', 'MovimentoController@store')->name('movimentos.store');
            Route::put('/movimentos/{movimento}', 'MovimentoController@update')->name('movimentos.update');
            Route::delete('/movimentos/{movimento}', 'MovimentoController@destroy')->name('movimentos.destroy');
            #endregion movimentos
        });
    });
});

