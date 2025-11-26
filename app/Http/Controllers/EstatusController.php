<?php

namespace App\Http\Controllers;

use App\Models\Estatus;
use Illuminate\Http\Request;

class EstatusController extends Controller
{
        public function index()
    {
        $estatus = Estatus::all();
        return $estatus;
    }

    public function show(Request $request)
    {
        $estatus = Estatus::where('id',$request->id)->get();
        return $estatus;
    }

    public function store(Request $request)
    {
        if($request->id==0){
            $estatus = new Estatus();
        }else{
            $estatus = Estatus::find($request->id);
        }
        $estatus->estatus = $request->estatus;
        $estatus->save();
        return "ok";
    }

    public function destroy(Request $request)
    {
        $estatus = Estatus::find($request->id);
        $estatus->delete();
        return "ok";
    }
}