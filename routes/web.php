<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminNoticeController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\TeacherDashboardController;
use App\Models\Notice;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Surface a curated selection of teachers for the landing page cards.
    $teachers = Teacher::ordered()->take(3)->get();
    // Get recent notices for the home page.
    $notices = Notice::orderByDesc('created_at')->take(5)->get();

    return view('welcome', compact('teachers', 'notices'));
})->name('home');

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');

Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
Route::get('/notices/{notice}', [NoticeController::class, 'show'])->name('notices.show');

// Public contact form submission
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Teacher management routes
        Route::post('/teachers', [AdminTeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{teacher}/edit', [AdminTeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{teacher}', [AdminTeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{teacher}', [AdminTeacherController::class, 'destroy'])->name('teachers.destroy');
        
        // Notice management routes
        Route::post('/notices', [AdminNoticeController::class, 'store'])->name('notices.store');
        Route::get('/notices/{notice}/edit', [AdminNoticeController::class, 'edit'])->name('notices.edit');
        Route::put('/notices/{notice}', [AdminNoticeController::class, 'update'])->name('notices.update');
        Route::delete('/notices/{notice}', [AdminNoticeController::class, 'destroy'])->name('notices.destroy');
        
        // Contact message routes
        Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
    });
});

// Teacher authentication and dashboard routes
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/login', [TeacherAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [TeacherAuthController::class, 'login']);
    Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('logout');

    Route::middleware('teacher.auth')->group(function () {
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
        Route::put('/profile', [TeacherDashboardController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [TeacherDashboardController::class, 'changePassword'])->name('password.change');
    });
});
