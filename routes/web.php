<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;

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

// Mostrar la lista de todos los puntos de interés en la ruta raíz
Route::get('/', [PlaceController::class, 'index']);

/*
Route::get('/places', [PlaceController::class, 'index'])->name('places.index');  // Lista de places
Route::get('/places/create', [PlaceController::class, 'create'])->name('places.create');  // Formulario para crear
Route::post('/places', [PlaceController::class, 'store'])->name('places.store');  // Guardar nuevo punto
Route::get('/places/{punto}', [PlaceController::class, 'show'])->name('places.show');  // Ver detalle de un punto específico
Route::get('/places/{punto}/edit', [PlaceController::class, 'edit'])->name('places.edit');  // Formulario para editar
Route::put('/places/{punto}', [PlaceController::class, 'update'])->name('places.update');  // Actualizar punto
Route::delete('/places/{punto}', [PlaceController::class, 'destroy'])->name('places.destroy');  // Eliminar punto
*/
Route::resource('places', PlaceController::class);