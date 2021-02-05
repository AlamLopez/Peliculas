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

Route::get('/main', function () {
    return view('contenido.contenido');
})->name('main');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('principal');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/roles', 'RolController@index');
Route::get('/roles/selectRol', 'RolController@selectRol');

Route::get('/categorias', 'CategoriaController@index');
Route::get('/categorias/selectCategoria', 'CategoriaController@selectRol');

Route::get('/usuarios', 'UserController@index');
Route::get('/usuarios/unico/{usuario}', 'UserController@unico');
Route::get('/usuarios/unico/{usuario}/{user_id}', 'UserController@unico2');
Route::get('/usuarios/unicoEmail/{email}', 'UserController@unico3');
Route::get('/usuarios/unicoEmail/{email}/{user_id}', 'UserController@unico4');
Route::get('/usuarios/getUser', 'UserController@getUser');
Route::get('/usuarios/selectUser', 'UserController@selectUser');
Route::post('/usuarios/registrar', 'UserController@store');
Route::put('/usuarios/actualizar', 'UserController@update');
Route::put('/usuarios/desactivar', 'UserController@desactivar');
Route::put('/usuarios/activar', 'UserController@activar');
