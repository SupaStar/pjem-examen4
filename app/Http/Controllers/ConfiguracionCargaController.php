<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\ConfiguracionCarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ConfiguracionCargaController extends Controller
{
    public function crear(Request $request)
    {
        $usuario = JWTAuth::parseToken()->authenticate();
        $validacion = Validator::make($request->all(), [
            'proporcion' => 'required|numeric',
            'diferencia' => 'required|numeric',
            'anio' => 'required|integer'
        ], [
            'proporcion.required' => 'La proporción es requerida',
            'proporcion.numeric' => 'La proporción debe ser un número',
            'diferencia.required' => 'La diferencia es requerida',
            'diferencia.numeric' => 'La diferencia debe ser un número',
            'anio.required' => 'El año es requerido',
            'anio.integer' => 'El año debe ser un número entero'
        ]);
        if ($validacion->fails()) {
            return response()->json(['estado' => false, 'errors' => $validacion->errors()->all()]);
        }
        $configuracion = new ConfiguracionCarga();
        $configuracion->proporcion = $request->input('proporcion');
        $configuracion->diferencia = $request->input('diferencia');
        $configuracion->anio = $request->input('anio');
        $configuracion->save();
        $bitacora = new Bitacora();
        $bitacora->id_Usuario = $usuario->id_usuario;
        $bitacora->cve_accion = 2;
        $bitacora->fecha = date('Y-m-d H:i:s');
        $bitacora->movimiento = 'Se creó la configuración de carga con id' . $configuracion->id_configuracion;
        $bitacora->save();
        return response()->json(['estado' => true, 'detalle' => $configuracion], 200);
    }
}
