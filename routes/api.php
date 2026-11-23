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

Route::post('/login', [AuthController::class, 'login']);

//Meto todas las rutas con un middleware y sactum para protegerlas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //Rutas de las diferentes entidades de mi proyecto
    Route::apiResource('academies', AcademyController::class); //Me genera las 5 de academias
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('students', StudentController::class);
});