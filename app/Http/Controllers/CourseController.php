<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Academy;
use App\Models\Student;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //devuelvo la respuesta del servidor en formato json
        return response()->json(Course::all());
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

    //Ruta No-Rest de la relación N:N con estudiantes
    public function students(Course $course)
    {
        return response()->json($course->students);
    }

    //Matricular a un estudiante
    public function enroll(Request $request, Course $course)
    {
        //Sólo el propietario puede matricular
        Gate::authorize('update', $course);

        //Valido el id del alumno a matricular
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        //Si ya existe el id significa que el alumno ya está matriculado
        if ($course->students->contains($data['student_id'])) {
            return response()->json(['message' => 'El alumno ya está matriculado en este curso'], 422);
        }

        //Lanzo error si el curso ya está completo
        if ($course->students()->count() >= $course->capacity) {
            return response()->json(['message' => 'El curso está completo'], 422);
        }

        //Si todo es correcto matriculo al estudiante
        $course->students()->attach($data['student_id']);

        //Devuelvo la respuesta HTTP 201 y json con mensaje de confirmación
        return response()->json(['message' => 'Alumno matriculado correctamente'], 201);
    }

    //Desmatricular a un estudiante
    public function unenroll(Course $course, Student $student)
    {
        //Sólo el propietario puede actualizar
        Gate::authorize('update', $course);

        //Si no se encuentra el id, significa que el alumno no está matriculado
        if (! $course->students->contains($student->id)) {
            return response()->json(['message' => 'El alumno no está matriculado en este curso'], 404);
        }
        
        //Se quita al alumno del curso
        $course->students()->detach($student->id);

        //Devuelvo json con confirmación de borrado respuesta HTTP
        return response()->json(null, 204);
    }
}
