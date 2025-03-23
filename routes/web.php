<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaultReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    //=======================================================================================
    // ADMIN ROUTES
    //=======================================================================================

    // Dashboard
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])
        ->name('admin.dashboard')
        ->middleware(['auth', 'role:admin']);

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::resource('users', UserController::class)->except(['index']);

    // Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::resource('departments', DepartmentController::class)->except(['index']);

    // Feedback
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks');
    Route::resource('feedbacks', FeedbackController::class)->except(['index']);

    // Reports
    Route::get('/reports', [FaultReportController::class, 'index'])->name('reports');
    Route::resource('reports', FaultReportController::class)->except(['index']);
    //=======================================================================================


    //=======================================================================================
    // MANAGER ROUTES
    //=======================================================================================

    // Dashboard
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])
        ->name('manager.dashboard')
        ->middleware(['auth', 'role:manager']);

    //=======================================================================================
    

    //=======================================================================================
    // STUDENT ROUTES
    //=======================================================================================

    // Dashboard
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
        ->name('student.dashboard')
        ->middleware(['auth', 'role:student']);

    //=======================================================================================
    

    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
