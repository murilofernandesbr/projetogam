<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/clientes', 'App\Http\Controllers\IndexClientes@index' );
Route::get('/clientes/criar', 'App\Http\Controllers\IndexClientes@create' );
Route::post('/clientes/criar', 'App\Http\Controllers\IndexClientes@store' );
Route::post('/clientes/{id}/editar', 'App\Http\Controllers\IndexClientes@updateCliente' )->name('alterarCliente');
Route::get('/clientes/{id}/editar', 'App\Http\Controllers\IndexClientes@editar' );


