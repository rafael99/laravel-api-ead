<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    CourseController
};

Route::get('cursos', [CourseController::class, 'index']);
Route::get('cursos/{id}', [CourseController::class, 'show']);

Route::get('/', function() {
    return response()->json([
        'success' => true
    ]);
});