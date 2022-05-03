<?php

use App\Http\Controllers\AccionController;
use App\Http\Controllers\ConfiguracionCargaController;
use App\Http\Controllers\GrupoSistemaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/crear_usuario', [UsuarioController::class, 'crear']);
Route::post('/iniciar_sesion', [UsuarioController::class, 'login']);
Route::prefix('grupo_sistema')->group(function () {
    Route::post('/crear', [GrupoSistemaController::class, 'crear']);
});
Route::prefix('usuarios')->group(function () {
    Route::delete('/eliminar/{id}', [UsuarioController::class, 'eliminar']);
    Route::get('/asesores', [UsuarioController::class, 'asesoresVentas']);
});
Route::group(['prefix' => 'configuracion_carga', 'middleware' => ['jwt.verify']], function () {
    Route::post('/crear', [ConfiguracionCargaController::class, 'crear']);
});
Route::group(['prefix' => 'solicitudes', 'middleware' => ['jwt.verify']], function () {
    Route::get('/todo', [SolicitudController::class, 'todo']);
    Route::post('/crear', [SolicitudController::class, 'crear']);
    Route::delete('/cancelar/{id}',[SolicitudController::class,'cancelar']);
    Route::get('/encontrar/{id}', [SolicitudController::class, 'cargar']);
});
Route::group(['prefix' => 'acciones'], function () {
    Route::post('/crear', [AccionController::class, 'crear']);
});
