<?php

use App\Http\Controllers\AccionController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/crear_accion', [AccionController::class, 'crear']);
