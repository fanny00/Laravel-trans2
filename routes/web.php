<?php

use App\Http\Controllers\EgresosController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
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
    return view('inicio');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/ingresos', [IngresosController::class, 'index'])->name('ingresos.index');
Route::post('/ingresos', [IngresosController::class, 'store']);
Route::delete('/ingresos{id}', [IngresosController::class, 'destroy'])->name('ingresos.destroy');

Route::get('/editar{id}', [IngresosController::class, 'show'])->name('editar');
Route::post('/editar', [IngresosController::class, 'update'])->name('editar.update');

Route::get('/egresos', [EgresosController::class, 'index'] )->name('egresos.index');
Route::post('/egresos', [EgresosController::class, 'store']);
Route::delete('/egresos{id}', [EgresosController::class, 'destroy'])->name('egresos.destroy');

Route::get('/editar-egreso{id}', [EgresosController::class, 'show'])->name('editar-egreso');
Route::post('/editar-egreso', [EgresosController::class, 'update'])->name('editar-egreso.update');
