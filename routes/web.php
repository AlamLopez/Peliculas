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

Route::get('/movimientos', 'MovimientoController@index');

Route::get('/roles', 'RolController@index');
Route::get('/roles/selectRol', 'RolController@selectRol');

Route::get('/categorias', 'CategoriaController@index');
Route::get('/categorias/selectCategoria', 'CategoriaController@selectCategoria');

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

Route::get('/peliculas', 'PeliculaController@index');
Route::get('/peliculas/unico/{pelicula}', 'PeliculaController@unico');
Route::get('/peliculas/unico/{pelicula}/{pelicula_id}', 'PeliculaController@unico2');
Route::get('/peliculas/unicoEmail/{email}', 'PeliculaController@unico3');
Route::get('/peliculas/unicoEmail/{email}/{pelicula_id}', 'PeliculaController@unico4');
Route::get('/peliculas/getPelicula', 'PeliculaController@getPelicula');
Route::get('/peliculas/selectPelicula', 'PeliculaController@selectPelicula');
Route::post('/peliculas/registrar', 'PeliculaController@store');
Route::put('/peliculas/actualizar', 'PeliculaController@update');
Route::put('/peliculas/desactivar', 'PeliculaController@desactivar');
Route::put('/peliculas/activar', 'PeliculaController@activar');

Route::get('/reporteria/movimientos-descargar', 'ReporteriaController@movimientoDescargar');
Route::post('/reporteria/movimientos', 'ReporteriaController@movimiento');
Route::get('/reporteria/usuarios-descargar', 'ReporteriaController@usuarioDescargar');
Route::post('/reporteria/usuarios', 'ReporteriaController@usuario');
Route::get('/reporteria/peliculas-descargar', 'ReporteriaController@peliculaDescargar');
Route::post('/reporteria/peliculas', 'ReporteriaController@pelicula');