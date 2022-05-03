<?php

namespace App\Http\Controllers;

use App\Models\GrupoSistema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioController extends Controller
{
    public function crear(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'login' => 'required',
            'password' => 'required',
            'cve_grupo' => 'required'
        ], [
            'nombre.required' => 'El nombre es requerido',
            'paterno.required' => 'El apellido paterno es requerido',
            'materno.required' => 'El apellido materno es requerido',
            'login.required' => 'El login es requerido',
            'password.required' => 'La contraseña es requerida',
            'cve_grupo.required' => 'El grupo es requerido'
        ]);
        if ($validacion->fails()) {
            return response()->json(['estado' => false, 'errors' => $validacion->errors()->all()]);
        }

        $usuario = new User();
        $usuario->nombre = $request->input('nombre');
        $usuario->paterno = $request->input('paterno');
        $usuario->materno = $request->input('materno');
        $usuario->login = $request->input('login');
        $usuario->password = Hash::make($request->input('password'));
        $usuario->activo = 1;
        $usuario->cve_grupo = $request->input('cve_grupo');
        $usuario->save();
        $token = JWTAuth::fromUser($usuario);
        return response()->json(['estado' => true, 'token' => $token], 200);
    }
    public function eliminar($id)
    {
        $usuario = User::find($id);
        if ($usuario) {
            $usuario->activo = 0;
            $usuario->save();
            return response()->json(['estado' => true, 'usuario' => $usuario], 200);
        }
        return response()->json(['estado' => false, 'errors' => ['No se encontró el usuario']], 200);
    }
    public function login(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required'
        ], [
            'login.required' => 'El login es requerido',
            'password.required' => 'La contraseña es requerida'
        ]);
        if ($validacion->fails()) {
            return response()->json(['estado' => false, 'errors' => $validacion->errors()->all()]);
        }
        $usuario = User::where('login', $request->input('login'))->where('activo', 1)->first();
        if ($usuario) {
            if (Hash::check($request->input('password'), $usuario->password)) {
                $token = JWTAuth::fromUser($usuario);
                return response()->json(['estado' => true, 'token' => $token], 200);
            }
            return response()->json(['estado' => false, 'errors' => ['La contraseña o el usuario son incorrectos']], 200);
        }
        return response()->json(['estado' => false, 'errors' => ['La contraseña o el usuario son incorrectos']], 200);
    }
    public function asesoresVentas()
    {
        $asesores = GrupoSistema::where('descripcion_grupo', 'Asesor de ventas')->first();
        if($asesores){
            $usuarios = User::where('cve_grupo', $asesores->cve_grupo_sistema)->where('activo', 1)->get();
            return response()->json(['estado' => true, 'asesores' => $usuarios], 200);
        }
        return response()->json(['estado' => false, 'errors' => ['No se encontraron asesores de ventas']], 200);
    }
}
