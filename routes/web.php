<?php

use App\Http\Controllers\usuarioController;
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
Route::middleware(['auth:api'])->group(function () {
Route::get('/', function () {
    return view('home');
});

Route::get('/usuarios', function () {
    return view('usuarios');
});

Route::post('/usuarios', [usuarioController::class,"Registrar"])->name('usuario.registro');
Route::get('/usuarios', [usuarioController::class,"Buscar"])->name('usuario.buscar');
});

Route::get('/login', function () {
    return view('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::post('/login', [LoginController::class, 'login'])->name('login');






