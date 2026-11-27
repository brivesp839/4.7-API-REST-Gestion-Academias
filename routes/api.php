<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rutas de autenticación
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//Cursos de una academia 
Route::get('/academy/{academy}/courses', [AcademyController::class, 'courses']);

//Meto todas las rutas con un middleware y sactum para protegerlas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //Estudiantes de un curso
    Route::get('/courses/{course}/students', [CourseController::class, 'students']);
    //Rutas para matricular y desmatricular estudiantes
    Route::post('/courses/{course}/students', [CourseController::class, 'enroll']);
    Route::delete('/courses/{course}/students/{student}', [CourseController::class, 'unenroll']);

    //Rutas de las diferentes entidades de mi proyecto
    Route::apiResource('academies', AcademyController::class); //Me genera las 5 de academias
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('students', StudentController::class);
});