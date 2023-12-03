<?php

use App\Http\Controllers\IngredientesController;
use App\Http\Controllers\PlatillosController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\PostresController;
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

Route::resource('postres', PostresController::class);
Route::get('/pagos/create/{orden}', [PagosController::class, 'create']);
Route::resource('pagos', PagosController::class);


Route::get('/generate-pdf', [PlatillosController::class, 'generatePDF'])->name('platillos.pdf.generate');
Route::get('/postres/generate-pdf', [PostresController::class, 'generatePDF'])->name('postres.pdf.generate');