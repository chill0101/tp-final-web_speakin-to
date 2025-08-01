<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AttachmentController;
use Illuminate\Support\Facades\Route;

// This file defines the web routes for the application, got a lot of headaches here (again :v)

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role ?? null;
    return match ($role) {
        'admin' => view('dashboard.admin'),
        'coordinator' => view('dashboard.coordinator'),
        'professor' => view('dashboard.professor'),
        default => view('dashboard.default'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// Admin: VIP FULL ACCESS
Route::middleware(['auth', 'role:admin'])->group(function () { // RoleMiddleware 
    Route::resource('students', StudentController::class); // Accesible routes
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('enrollments', EnrollmentController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::resource('attachments', AttachmentController::class);
    Route::get('attachments/{attachment}/download', [AttachmentController::class, 'download'])->name('attachments.download');
    // attachments path using placeholder {attachment}  
});

// Teacher and Coordinator: access to enrollments
Route::middleware(['auth', 'role:coordinator,professor'])->group(function () {
    // Coordinator: students and enrollments (except destroy)
    Route::resource('students', StudentController::class)->except(['destroy']);
    // Enrollments: coordinator all except destroy, professor only index and show
    Route::resource('enrollments', EnrollmentController::class)->except(['destroy']);
});

// Professor: evaluations, attachments and view assigned courses
Route::middleware(['auth', 'role:professor'])->group(function () {
    Route::resource('courses', CourseController::class)->only(['index', 'show']);
    Route::resource('evaluations', EvaluationController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update']);
    Route::resource('attachments', AttachmentController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('attachments/{attachment}/download', [AttachmentController::class, 'download'])->name('attachments.download');
});

require __DIR__.'/auth.php'; // The powerful authentication routes
