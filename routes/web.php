<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlmacenController;
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
    Route::post('/', [UsuarioController::class,'Registrar'])->name('usuario.registro');
    Route::get('/{id}', [UsuarioController::class, 'Buscar'])->name('usuario.buscar');
    Route::delete('/{id}', [UsuarioController::class, 'Eliminar'])->name('usuario.eliminar');


});

Route::prefix('almacenes')->group(function (){
    Route::get('/', [AlmacenController::class, 'VerTodo'])->name('almacen.verTodos');
    Route::post('/', [AlmacenController::class, 'Registrar'])->name('almacen.registro');
});

});


Route::get('/login', function () {
    return view('login');})->name('login');;

Route::post('/login', [LoginController::class, 'Login'])->name('Login');
Route::get('/logout', [LoginController::class, 'Logout'])->name('Logout');





