<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Places\PlaceController;

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
Route::resource('places', PlaceController::class);