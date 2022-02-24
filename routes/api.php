<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController,
    LessonController,
    ModuleController,
    SupportController
};

Route::get('cursos', [CourseController::class, 'index']);
Route::get('cursos/{id}', [CourseController::class, 'show']);

Route::get('cursos/{id}/modulos', [ModuleController::class, 'index']);

Route::get('modulos/{id}/aulas', [LessonController::class, 'index']);
Route::get('aulas/{id}', [LessonController::class, 'show']);

Route::get('suportes', [SupportController::class, 'index']);
Route::post('suportes', [SupportController::class, 'store']);

Route::get('/', function() {
    return response()->json([
        'success' => true
    ]);
});