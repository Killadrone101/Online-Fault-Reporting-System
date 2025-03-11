<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaultReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::resource('users', UserController::class)->except(['index']);

    // Departments
    Route::get('/departments', [UserController::class, 'index'])->name('departments');
    Route::resource('departments', UserController::class)->except(['index']);

    // Employees
    Route::get('/employees', [UserController::class, 'index'])->name('employees');
    Route::resource('employees', UserController::class)->except(['index']);

    // Feedback
    Route::get('/feedbacks', [UserController::class, 'index'])->name('feedbacks');
    Route::resource('feedbacks', UserController::class)->except(['index']);

    // Reports
    Route::get('/reports', [UserController::class, 'index'])->name('reports');
    Route::resource('reports', UserController::class)->except(['index']);


    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
