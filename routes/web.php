<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\LectureController;
use App\Http\Controllers\Teacher\CourseController;


Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/teacher/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/teacher/login/attempt', [WebAuthController::class, 'loginAdmin'])->name('admin.login.attempt');


// Teacher Dashboard (Protected)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::post('/logout', [WebAuthController::class, 'logoutAdmin'])->name('admin.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('admin.courses.show');

    // Lectures (Linked to Course)
    Route::get('/lectures/create/{course_id}', [LectureController::class, 'create'])->name('admin.lectures.create');
    Route::post('/lectures', [LectureController::class, 'store'])->name('admin.lectures.store');
});
