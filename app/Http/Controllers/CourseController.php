<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Academy;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Lista con los ids de las academias del usuario autenticado    
        $academyIds = $request->user()->academies()->pluck('id');

        //Obtengo los cursos de dichas academias
        $courses = Course::whereIn('academy_id', $academyIds)->get();

        //devuelvo la respuesta del servidor en formato json
        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //valido los datos que el usuario introduce
        $data = $request->validate([
            'academy_id' => 'required|exists:academies,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'capacity' => 'required|integer|min:1',
        ]);

        //Obtengo la academia 
        $academy = Academy::findOrFail($data['academy_id']);

        //Verifico que el usuario esté autorizado a la creacion de nuevo curso
        Gate::authorize('update', $academy);

        //Creo el nuevo curso
        $course = Course::create($data);

        //Devuelvo el curso creado y respuesta en formato json
        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //Verifico que el usuario este autorizado a ver el curso
        Gate::authorize('view', $course);

        //Devuelvo respuesta     
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //Verifico autoridad del usuario
        Gate::authorize('update', $course);

        //Valido sólo los datos que se cambian
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date',
            'capacity' => 'sometimes|required|integer|min:1',
        ]);

        //Actualizo el curso
        $course->update($data);

        //Devuelvo respuesta
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //Verifico autoridad del usuario
        Gate::authorize('delete', $course);

        //Borro el curso
        $course->delete();

        //devuelvo respuesta
        return response()->json(null, 204);
    }
}
