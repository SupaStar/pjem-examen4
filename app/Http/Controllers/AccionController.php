<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccionController extends Controller
{
    public function crear()
    {
        $validaciones= Validator::make(request()->all(), [
            'descripcion' => 'required',
        ], [
            'descripcion.required' => 'La descripción es requerida',
        ]);
        if ($validaciones->fails()) {
            return response()->json(['estado' => false, 'errors' => $validaciones->errors()->all()]);
        }
        if(Accion::where('descripcion', request()->input('descripcion'))->count() > 0){
            return response()->json(['estado' => false, 'errors' => ['La acción ya existe']], 200);
        }
        $accion = new Accion();
        $accion->descripcion = request()->input('descripcion');
        $accion->activo = 1;
        $accion->save();
        return response()->json(['estado' => true, 'accion' => $accion], 200);
    }
}
