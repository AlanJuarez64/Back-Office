<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\LoginController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::prefix('usuarios')->group(function (){
    
        Route::get('/', function () {
            return view('usuarios');});

        Route::get('/all', [UsuarioController::class, 'verTodos'])->name('usuarios.verTodos');
        Route::put('/{id}', [UsuarioController::class, 'Modificar'])->name('usuarios.modificar');
        Route::post('/', [UsuarioController::class,'Registrar'])->name('usuario.registro');
        Route::get('/{id}', [UsuarioController::class, 'Buscar'])->name('usuario.buscar');
        Route::delete('/{id}', [UsuarioController::class, 'Eliminar'])->name('usuario.eliminar');

    });

    Route::prefix('almacenes')->group(function (){
        Route::get('/', [AlmacenController::class, 'VerTodo'])->name('almacen.verTodos');
        Route::get('/{id}', [AlmacenController::class, 'VerMas'])->name('almacen.verMas');
        Route::post('/', [AlmacenController::class, 'Registrar'])->name('almacen.registro');
        Route::put('/{id}', [AlmacenController::class, 'Modificar'])->name('almacen.modificar');
        Route::delete('/{id}', [AlmacenController::class, 'Eliminar'])->name('almacen.eliminar');
    });

    Route::prefix('entregas')->group(function (){
        Route::get('/', [ArticuloController::class, 'VerTodo'])->name('articulo.verTodos');
        Route::delete('/{id}', [ArticuloController::class, 'ConfirmarEntrega'])->name('articulo.confirmar');
    });

});


Route::get('/login', function () {
    return view('login');})->name('login');;

Route::post('/login', [LoginController::class, 'Login'])->name('Login');
Route::get('/logout', [LoginController::class, 'Logout'])->name('Logout');





