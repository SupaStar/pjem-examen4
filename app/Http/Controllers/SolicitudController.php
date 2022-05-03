<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class SolicitudController extends Controller
{
    public function todo()
    {
        $solicitudes = Solicitud::where('activo', 1)->get();
        foreach ($solicitudes as $solicitud) {
            $solicitud->usuario;
        }
        return response()->json(['estado' => true, 'detalle' => $solicitudes]);
    }
    public function crear(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'id_Usuario_Asignado' => 'required',
            'nombre_Solicitante' => 'required',
            'paterno_Solicitante' => 'required',
            'materno_Solicitante' => 'required',
        ], [
            'id_Usuario_Asignado.required' => 'El id del usuario asignado es requerido',
            'nombre_Solicitante.required' => 'El nombre del solicitante es requerido',
            'paterno_Solicitante.required' => 'El apellido paterno del solicitante es requerido',
            'materno_Solicitante.required' => 'El apellido materno del solicitante es requerido',
        ]);
        if ($validacion->fails()) {
            return response()->json(['estado' => false, 'errors' => $validacion->errors()->all()]);
        }
        $usuario = JWTAuth::parseToken()->authenticate();
        $solicitud = new Solicitud();
        $solicitud->id_Usuario_Asignado = $request->input('id_Usuario_Asignado');
        $solicitud->nombre_Solicitante = $request->input('nombre_Solicitante');
        $solicitud->paterno_Solicitante = $request->input('paterno_Solicitante');
        $solicitud->materno_Solicitante = $request->input('materno_Solicitante');
        $solicitud->activo = 1;
        $solicitud->fecha_Solicitud = date('Y-m-d H:i:s');
        $solicitud->save();
        $bitacora = new Bitacora();
        $bitacora->id_Usuario = $usuario->id_usuario;
        $bitacora->cve_accion = 2;
        $bitacora->fecha = date('Y-m-d H:i:s');
        $bitacora->movimiento = 'Se creó la solicitud con id' . $solicitud->id_Solicitud;
        $bitacora->save();
        return response()->json(['estado' => true, 'detalle' => $solicitud], 200);
    }
    public function cancelar($id){
        $usuario = JWTAuth::parseToken()->authenticate();
        $solicitud=Solicitud::find($id);
        $solicitud->activo=0;
        $solicitud->save();
        $bitacora = new Bitacora();
        $bitacora->id_Usuario = $usuario->id_usuario;
        $bitacora->cve_accion = 3;
        $bitacora->fecha = date('Y-m-d H:i:s');
        $bitacora->movimiento = 'Se canceló la solicitud con id' . $solicitud->id_Solicitud;
        $bitacora->save();
        return response()->json(['estado' => true], 200);
    }
    public function cargar($id){
        $solicitud=Solicitud::find($id);
        $solicitud->usuario;
        return response()->json(['estado' => true, 'detalle' => $solicitud], 200);
    }
}
