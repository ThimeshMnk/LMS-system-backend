<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\StudentCourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuizController;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/courses', [StudentCourseController::class, 'index']);
Route::get('/courses/{id}', [StudentCourseController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/lectures/{id}', [StudentCourseController::class, 'showLecture']);
    // 2. Ensure your Quiz routes are here too
    Route::get('/lectures/{id}/questions', [QuizController::class, 'getQuestions']);
    Route::post('/quiz/submit', [QuizController::class, 'submit']);
});
