<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaultReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\ManagerFaultReportController;
use App\Http\Controllers\Manager\ManagerFeedbackController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentFaultReportController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    //=======================================================================================
    // ADMIN ROUTES
    //=======================================================================================
    Route::prefix('admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [UserController::class, 'dashboard'])
            ->name('admin.dashboard')
            ->middleware('role:admin');

        // Users
        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users')
            ->middleware('role:admin');
        Route::resource('users', UserController::class)->except(['index'])
            ->names([
                'create' => 'admin.users.create',
                'store' => 'admin.users.store',
                'show' => 'admin.users.show',
                'edit' => 'admin.users.edit',
                'update' => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]);

        // Departments
        Route::get('/departments', [DepartmentController::class, 'index'])
            ->name('admin.departments')
            ->middleware('role:admin');
        Route::resource('departments', DepartmentController::class)->except(['index'])
            ->names([
                'create' => 'admin.departments.create',
                'store' => 'admin.departments.store',
                'show' => 'admin.departments.show',
                'edit' => 'admin.departments.edit',
                'update' => 'admin.departments.update',
                'destroy' => 'admin.departments.destroy',
            ]);

    });

    //=======================================================================================
    // MANAGER ROUTES
    //=======================================================================================
    Route::prefix('manager')->group(function () {
        // Dashboard
        Route::get('/dashboard', [ManagerController::class, 'dashboard'])
            ->name('manager.dashboard')
            ->middleware('role:manager');


        // Feedback
        Route::get('/feedbacks', [ManagerFeedbackController::class, 'index'])
            ->name('manager.feedbacks')
            ->middleware('role:manager');
        Route::resource('feedbacks', ManagerFeedbackController::class)->except(['index'])
            ->names([
                'create' => 'manager.feedbacks.create',
                'store' => 'manager.feedbacks.store',
                'show' => 'manager.feedbacks.show',
                'edit' => 'manager.feedbacks.edit',
                'update' => 'manager.feedbacks.update',
                'destroy' => 'manager.feedbacks.destroy',
            ]);
        

        // Reports
        Route::get('/reports', [ManagerFaultReportController::class, 'index'])
            ->name('manager.reports')
            ->middleware('role:manager');
        Route::resource('reports', ManagerFaultReportController::class)->except(['index'])
            ->names([
                'create' => 'manager.reports.create',
                'store' => 'manager.reports.store',
                'show' => 'manager.reports.show',
                'edit' => 'manager.reports.edit',
                'update' => 'manager.reports.update',
                'destroy' => 'manager.reports.destroy',
            ]);
    });

    //=======================================================================================
    // STUDENT ROUTES
    //=======================================================================================
    Route::prefix('student')->group(function () {
        // Dashboard
        Route::get('/dashboard', [StudentController::class, 'dashboard'])
            ->name('student.dashboard')
            ->middleware('role:student');
        
        // Reports
        Route::get('/reports', [StudentFaultReportController::class, 'index'])
            ->name('student.reports')
            ->middleware('role:student');
        Route::resource('reports', StudentFaultReportController::class)->except(['index'])
            ->names([
                'create' => 'student.reports.create',
                'store' => 'student.reports.store',
                'show' => 'student.reports.show',
                'edit' => 'student.reports.edit',
                'update' => 'student.reports.update',
                'destroy' => 'student.reports.destroy',
            ]);

    });

    //=======================================================================================
    // SHARED ROUTES
    //=======================================================================================
    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';