<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AcademyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //Lista todas las academias
    public function index(Request $request)
    {
        //Devuelvo la respuesta en formato JSON
        return response()->json($request->user()->academies);
    }

    //Crea una nueva academia 
    public function store(Request $request)
    {
        //Valido los datos que llegan en la petición 
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        //Creo la academia en la base de datos
        $academy = $request->user()->academies()->create($data);

        //Devuelvo la academia creada con el codigo HTTP 201
        return response()->json($academy, 201);
    }

    /**
     * Display the specified resource.
     */
    //Devuelve solo 1 academia
    public function show(Academy $academy)
    {
        //Comprobar que sólo la persona autenticada pueda ver la academia
        Gate::authorize('view', $academy); //llama a la policy: false devuelve 403

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
