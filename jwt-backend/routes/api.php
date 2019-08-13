<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/medicamento-salvar', 'MedicamentoController@salvar');

Route::delete('/medicamento-deletar/{id}', 'MedicamentoController@destroy');

Route::get('/lista-medicamentos', 'MedicamentoController@index');

Route::post('/usuario/criar', 'Auth\RegisterController@create');

Route::post('/usuario/login', 'Auth\LoginController@loginComSenha');
