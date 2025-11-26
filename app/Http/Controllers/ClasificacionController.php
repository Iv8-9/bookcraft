<?php

namespace App\Http\Controllers;

use App\Models\Clasificacion;
use Illuminate\Http\Request;

class ClasificacionController extends Controller
{
public function index()
    {
        $clasificacion = Clasificacion::all();
        return $clasificacion;
    }

    public function show(Request $request)
    {
        $clasificacion = Clasificacion::where('id',$request->id)->get();
        return $clasificacion;
    }

    public function store(Request $request)
    {
        if($request->id==0){
            $clasificacion = new Clasificacion();
        }else{
            $clasificacion = Clasificacion::find($request->id);
        }
        $clasificacion->clasificacion = $request->clasificacion;
        $clasificacion->save();
        return "ok";
    }

    public function destroy(Request $request)
    {
        $clasificacion = Clasificacion::find($request->id);
        $clasificacion->delete();
        return "ok";
    }
}
