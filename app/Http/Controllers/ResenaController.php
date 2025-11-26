<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
public function index()
    {
        $resena = Resena::all();
        return $resena;
    }

    public function show(Request $request)
    {
        $resena = Resena::find( $request->id);
        return $resena;
    }

    public function store(Request $request)
    {
        if($request->id==0){
            $resena = new Resena();
        }else{
            $resena = Resena::find($request->id);
        }
        $resena->id_libro = $request->id_libro;
        $resena->descripcion = $request->descripcion;
        $resena->resena = $request->resena;
        $resena->save();
        return "ok";
    }

    public function destroy(Request $request)
    {
        $resena = Resena::find($request->id);
        $resena->delete();
        return "ok";
    }
}
