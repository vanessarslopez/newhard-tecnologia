<?php

use Illuminate\Support\Facades\Auth;
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
    //return view('auth.login');
});

# CRUD Usuarios
//Route::resource('usuarios','UsuarioController');

# CRUD productos
#validar ingreso: ->middleware(auth())
Route::resource('productos','ProductoController');

# CRUD rubros
Route::resource('productos/rubros','RubroController');

# CRUD carrito
Route::resource('carritos','CarritoController');
//Route::post('carritos', 'CarritoController@add')->name('cart.add');


//Si quiero deshabilitar el botón “Registrarse” y “olvide contraseña”
Auth::routes(['register'=>false,'reset'=>false]);
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\CarritoController::class, 'index'])->name('carrito');
Route::get('/home', [App\Http\Controllers\ProductoController::class, 'index'])->name('productos');
