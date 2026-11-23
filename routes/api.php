<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rutas de las diferentes entidades de mi proyecto
Route::apiResource('academies', AcademyController::class); //Me genera las 5 de academias
Route::apiResource('courses', CourseController::class);
Route::apiResource('students', StudentController::class);
