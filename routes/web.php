<?php

use App\Http\Controllers\IngredientesController;
use App\Http\Controllers\PlatillosController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagosController;
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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/usuarios', [App\Http\Controllers\UsuariosController::class, 'index'])->name('usuarios.index');
Route::delete('/usuarios/{usuario}', [App\Http\Controllers\UsuariosController::class, 'destroy'])->name('usuarios.destroy');
Route::resource('ingredientes', IngredientesController::class);
Route::resource('platillos', PlatillosController::class);

Route::resource('ordenes', OrdersController::class);
Route::get('/pagos/create/{orden}', [PagosController::class, 'create']);
Route::resource('pagos', PagosController::class);

// Rutas para terminar o cancelar una orden
Route::put('/orden/{orden}/terminar', [OrdersController::class, 'terminar'])->name('orden.terminar');
Route::put('/orden/{orden}/cancelar', [OrdersController::class, 'cancelar'])->name('orden.cancelar');

// Ruta para agregar un platillo a una orden
Route::post('/ordenes/agregar', [OrdersController::class, 'agregar'])->name('ordenes.agregar');
Route::get('/generate-pdf', [PlatillosController::class, 'generatePDF'])->name('platillos.pdf.generate');
Route::get('/orders/generate-pdf', [OrdersController::class, 'generatePDF'])->name('orders.pdf.generate');