<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function index()
    {
        $libro = Libro::all();
        return $libro;
    }

    public function libros_resena()
    {
        $libro = Libro::query()
        ->join('resena', 'libro.id', '=', 'resena.id_libro')
        ->select(
            'libro.*',
            'libro.id AS id_libro',
            'resena.id AS id_resena'
        )
        ->get();
        return $libro;
    }

    public function show(Request $request)
    {
        $libro = Libro::where('id', $request->id)->get();
        return $libro;
    }

    public function show_libros_lector(Request $request)
    {
        $libro = Libro::where('id_lector', $request->id_lector)
            ->get();
        return $libro;
    }

    public function show_libros_resena_lector(Request $request)
    {
        $libro = Libro::where('libro.id_lector', $request->id_lector)
            ->leftJoin('resena', 'libro.id', '=', 'resena.id_libro')
            ->select(
                'libro.*',
                'resena.id AS id_resena'
            )
            ->get();

        return $libro;
    }

    public function show_libros_resenas_lector(Request $request)
    {
        $libro = Libro::where('libro.id_lector', $request->id_lector)
            ->Join('resena', 'libro.id', '=', 'resena.id_libro')
            ->select(
                'libro.*',
                'resena.id AS id_resena'
            )
            ->get();

        return $libro;
    }

    public function show_libro_resena(Request $request)
    {
        $libro = Libro::where('libro.id', $request->id)
            ->Join('resena', 'libro.id', '=', 'resena.id_libro')
            ->select(
                'libro.*',
                'resena.*'
            )
            ->first();

        return $libro;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $libro = new Libro();
        } else {
            $libro = Libro::find($request->id);
        }
        $libro->id_lector = $request->id_lector;
        $libro->nombre_libro = $request->nombre_libro;
        $libro->autor = $request->autor;
        $libro->genero = $request->genero;
        $libro->no_paginas = $request->no_paginas;
        $libro->imagen = $request->imagen;
        $libro->personaje_favorito = $request->personaje_favorito;
        $libro->personaje_odiado = $request->personaje_odiado;
        $libro->tipo_libro = $request->tipo_libro;
        $libro->modo_lectura = $request->modo_lectura;

        $libro->fecha_publicacion = $request->fecha_publicacion;
        $libro->frase_favorita = $request->frase_favorita; // Nuevo 
        $libro->save();
        return "ok";
    }

    public function destroy(Request $request)
    {
        $libro = Libro::find($request->id);
        $libro->delete();
        return "ok";
    }

    public function buscar_libros_resenas(Request $request)
    {
        $texto = strtolower($request->texto); // convertir a minúsculas

        $query = Libro::leftJoin('resena', 'libro.id', '=', 'resena.id_libro')
            ->select('libro.nombre_libro')
            ->whereRaw('LOWER(libro.nombre_libro) LIKE ?', ["%{$texto}%"]);

        return $query->get();
    }
}
