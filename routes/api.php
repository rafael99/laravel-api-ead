<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController,
    LessonController,
    ModuleController,
    ReplySupportController,
    SupportController
};
use App\Http\Controllers\Api\Auth\AuthController;

Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cursos', [CourseController::class, 'index']);
    Route::get('/cursos/{id}', [CourseController::class, 'show']);

    Route::get('/cursos/{id}/modulos', [ModuleController::class, 'index']);

    Route::get('/modulos/{id}/aulas', [LessonController::class, 'index']);
    Route::get('/aulas/{id}', [LessonController::class, 'show']);

    Route::get('/meus-suportes', [SupportController::class, 'mySupports']);
    Route::get('/suportes', [SupportController::class, 'index']);
    Route::post('/suportes', [SupportController::class, 'store']);

    Route::post('/respostas', [ReplySupportController::class, 'store']);
});


Route::get('/', function() {
    return response()->json([
        'success' => true
    ]);
});