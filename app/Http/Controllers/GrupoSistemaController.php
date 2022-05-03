<?php

namespace App\Http\Controllers;

use App\Models\GrupoSistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoSistemaController extends Controller
{
    public function crear(Request $request)
    {
        $validaciones = Validator::make($request->all(), [
            'descripcion' => 'required',
        ], [
            'descripcion.required' => 'La descripción es requerida',
        ]);
        if ($validaciones->fails()) {
            return response()->json(['estado' => false, 'errors' => $validaciones->errors()->all()]);
        }
        $grupo = new GrupoSistema();
        $grupo->descripcion_grupo = $request->input('descripcion');
        $grupo->activo = 1;
        $grupo->save();
        return response()->json(['estado' => true, 'grupo' => $grupo], 200);
    }
}
