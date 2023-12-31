<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\AgenciasController;
use App\Http\Controllers\AsistenciasController;
use App\Http\Controllers\CargosController;
use App\Http\Controllers\EjecutivosController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/asistencias', [App\Http\Controllers\AsistenciasController::class, 'index'])->name('asistencias')->middleware('auth');

Route::group(['middleware' => 'canAccess'], function () {
    Route::resources([
        'agencias' => AgenciasController::class,
    ]);
    Route::resources([
        'cargos' => CargosController::class,
    ]);
    Route::resources([
        'ejecutivos' => EjecutivosController::class,
    ]);
});

Route::get('/exportar_excel', [App\Http\Controllers\AsistenciasController::class, 'exportarExcelForm'])->name('exportar-form')->middleware('auth');
Route::post('/exportar', [App\Http\Controllers\AsistenciasController::class, 'exportarExcel'])->name('exportar')->middleware('auth');



Route::post('api_ejecutivos', [EjecutivosController::class, 'index_api'])->name('api_ejecutivos');
Route::post('api_ejecutivos_cargo', [EjecutivosController::class, 'get_api_cargo'])->name('api_ejecutivos_cargo');
Route::get('api_ejecutivos_tem', [AsistenciasController::class, 'get_asistencias_temporal'])->name('api_ejecutivos_tem');
Route::post('api_ejecutivos_tem', [AsistenciasController::class, 'set_asistencia_temporal'])->name('api_ejecutivos_tem');
Route::post('api_ejecutivos_delete', [AsistenciasController::class, 'delete_asistencias_temporal'])->name('api_ejecutivos_delete');

Route::post('api_asistencias_store', [AsistenciasController::class, 'store_asistencias'])->name('api_asistencias_store');
