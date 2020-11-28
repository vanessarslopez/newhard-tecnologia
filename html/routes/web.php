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


/**
 * Productos
 */
//Route::get('/productos', function () {
  //  return view('productos.index');
//});
//Route::get('/productos','ProductoController@index');
//Route::get('/productos/crear', function () {
  //  return view('productos.create');
//});
//Route::get('/productos/crear','ProductoController@create');
//Route::get('/productos/editar','ProductoController@edit');
Route::resource('productos','ProductoController');

