<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//CRUD API

Route::apiResource('clientes', \App\Http\Controllers\ClientesController::class);
Route::apiResource('telefones', \App\Http\Controllers\TelefonesController::class);
Route::apiResource('tipostelefone', \App\Http\Controllers\TipoController::class);


//ROTAS


Route::get('clientes/cpf/{cpf}', function($cpf){
    $result =   DB::table('clientes')->where('cpf', $cpf)->get(); 
    return \response($result);
});

Route::get('clientes/nome/{nome}', function($nome){
    $result =   DB::table('clientes')->where('nome' , 'LIKE', '%' . $nome . '%')->get(); 
    return \response($result);
});

Route::get('clientes/email/{email}', function($email){
    $result =   DB::table('clientes')->where('email', $email)->get(); 
    return \response($result);
});

Route::get('telefones/cliente/{id}', function($id){
    $result = DB::table('cliente_telefones')->where('cliente_id', $id)->get(); 
    return \response($result);
});

Route::delete('telefones/cliente/{id}', function($id){
    $result =   DB::table('cliente_telefones')->where('cliente_id', $id)->delete(); 
    return \response($result);
});





