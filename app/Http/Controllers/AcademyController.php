<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use Illuminate\Http\Request;

class AcademyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //Lista todas las academias
    public function index()
    {
        //Obtengo las academias
        $academies = Academy::all();

        //Devuelvo la respuesta en formato JSON
        return response()->json($academies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    //Devuelve solo 1 academia
    public function show(Academy $academy)
    {
        //Comprobar que sólo la persona autenticada pueda ver la academia
        
        /*Gracias al route model Binding que prepare en --model=Academy 
        al crear el controlador, Laravel ya busca la academia por mí y la entrega
        en $academy
        */
        return response()->json($academy);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academy $academy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academy $academy)
    {
        //
    }
}
