<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $users = Usuario::all();
        return $users;
    }

    public function show(Request $request)
    {
        $users = Usuario::find($request->id);
        return $users;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $users = new Usuario();
        } else {
            $users = Usuario::find($request->id);
        }

        $users->name = $request->name;
        $users->email = $request->email;

        if ($request->filled('password')) {
            $users->password = Hash::make($request->password);
        }

        $users->app_lector = $request->app_lector;
        $users->apm_lector = $request->apm_lector;
        $users->usuario = $request->usuario;
        $users->edad = $request->edad;
        $users->fecha_nacimiento = $request->fecha_nacimiento;
        $users->suscripcion = $request->suscripcion;

        $users->save();

        return "ok";
    }

    public function update(Request $request)
    {
        if ($request->id == 0) {
            $users = new Usuario();
        } else {
            $users = Usuario::find($request->id);
        }

        $users->name = $request->name;
        $users->app_lector = $request->app_lector;
        $users->apm_lector = $request->apm_lector;
        $users->save();
        return "ok";
    }

    public function premium(Request $request)
    {
        $users = Usuario::find($request->id);
        $users->suscripcion = true;
        $users->save();
        return "ok";
    }

    public function destroy(Request $request)
    {
        $users = Usuario::find($request->id);
        $users->delete();
        return "ok";
    }
}
