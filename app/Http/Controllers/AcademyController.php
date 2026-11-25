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
    public function index()
    {
        //Devuelvo la respuesta en formato JSON
        return response()->json(Academy::all()); //el usuario podrá ver todas las academias existentes
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
        /*Gracias al route model Binding que prepare en --model=Academy 
        al crear el controlador, Laravel ya busca la academia por mí y la entrega
        en $academy
        */
        return response()->json($academy);
    }

    //Modifica una academia
    public function update(Request $request, Academy $academy)
    {
        //Verifico que el que actualiza es el dueño del proyecto usando regla de policy
        Gate::authorize('update', $academy);
        
        //Valido los campos únicamente los que sean cambiados usando sometimes
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|required|email|max:255',
        ]);

        //Realizo la consulta a la BD
        $academy->update($data);

        //Devuelvo los datos actualizados de la academia
        //No se incluye user_id porque la academia no cambia de dueño
        return response()->json($academy);
    }

    //Borra una academia
    public function destroy(Academy $academy)
    {
        //Verifico que el que borra es el dueño del proyecto usando regla de policy
        Gate::authorize('delete', $academy);

        //Realizo la consulta de borrado
        $academy->delete();

        //Devuelvo la respuesta
        return response()->json(null, 204);
    }
}
