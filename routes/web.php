<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\LectureController;
// Auth Routes
Route::get('/teacher/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/teacher/login/attempt', [WebAuthController::class, 'loginAdmin'])->name('admin.login.attempt');


// Teacher Dashboard (Protected)
Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::post('/logout', [WebAuthController::class, 'logoutAdmin'])->name('admin.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/lectures', [LectureController::class, 'index'])->name('admin.lectures.index');
    Route::get('/lectures/create', [LectureController::class, 'create'])->name('admin.lectures.create');
    Route::post('/lectures', [LectureController::class, 'store'])->name('admin.lectures.store');
});