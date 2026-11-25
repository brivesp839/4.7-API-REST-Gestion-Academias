<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; //Para la validación del email en update

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Devuelvo la respuesta en formato JSON
        return response()->json(Student::all());

    }

    //Creo un nuevo usuario
    public function store(Request $request)
    {
        //Valido los datos que llegan en la petición 
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date|before:today',
        ]);

        //Lanzo la consulta para crear al nuevo estudiante
        $student = Student::create($data);

        //Doy la respuesta en formato json
        return response()->json($student, 201);
        
    }

    //Devuelve 1 estudiante
    public function show(Student $student)
    {
        //Busco y entrego al estudiante
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //Valido los datos que introduce el usuario
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'surname' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes', 'required', 'email', 'max:255',
                Rule::unique('students', 'email')->ignore($student->id),
            ],
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'sometimes|required|date|before:today',
        ]);

        //Lanzo la consulta para actualizar los datos
        $student->update($data);

        //Doy respuesta en formato json 
        return response()->json($student);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //borro al estudiante
        $student->delete();

        //Doy código 204 confirmando que se borró exitosamente
        return response()->json(null, 204);
    }
}
