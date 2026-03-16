<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AuthController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Submission
Route::get('/submission', [SubmissionController::class, 'create'])->name('submission');
Route::post('/submission', [SubmissionController::class, 'store'])->name('submission.store');
Route::put('/submission/{submission}/reupload', [SubmissionController::class, 'reUpload'])->name('submission.reupload');

// Tracking
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::post('/tracking', [TrackingController::class, 'track'])->name('tracking.search');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Submissions
    Route::get('/submissions', [AdminController::class, 'submissions'])->name('submissions');
    Route::get('/submissions/{submission}', [AdminController::class, 'showSubmission'])->name('submissions.show');
    Route::patch('/submissions/{submission}/status', [AdminController::class, 'updateStatus'])->name('submissions.update-status');

    // Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::patch('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
});
