<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminNoticeController;
use App\Http\Controllers\AdminResultController;
use App\Http\Controllers\AdminTeacherController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AdminAuditLogController;
use App\Http\Controllers\AcademicResourceController;
use App\Http\Controllers\AdminAcademicResourceController;
use App\Http\Controllers\AdminBatchController;
use App\Http\Controllers\CareerOpportunityController;
use App\Http\Controllers\AdminCareerOpportunityController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AdminProgramController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\AdminClubController;
use App\Models\Notice;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    // Cache teachers for 1 hour to improve performance
    $teachers = Cache::remember('homepage_teachers', 3600, function () {
        return Teacher::select('id', 'name', 'designation', 'profile_image', 'short_bio', 'research_interests', 'is_head')
            ->ordered()
            ->take(3)
            ->get();
    });
    
    // Cache notices for 30 minutes to improve performance
    $notices = Cache::remember('homepage_notices', 1800, function () {
        return Notice::select('id', 'title', 'content', 'created_at')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();
    });

    return view('welcome', compact('teachers', 'notices'));
})->name('home');

Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');

Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
Route::get('/notices/{notice}', [NoticeController::class, 'show'])->name('notices.show');

// Academic Resources - Public facing
Route::get('/academic-resources', [AcademicResourceController::class, 'index'])->name('academic-resources.index');

// Career Opportunities - Public facing
Route::get('/career-opportunities', [CareerOpportunityController::class, 'index'])->name('career-opportunities.index');
Route::get('/career-opportunities/{opportunity}', [CareerOpportunityController::class, 'show'])->name('career-opportunities.show');

// Programs - Public facing
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program}', [ProgramController::class, 'show'])->name('programs.show');

// Clubs - Public facing
Route::get('/clubs', [ClubController::class, 'index'])->name('clubs.index');
Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('clubs.show');

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

        // Audit logs
        Route::get('/audit-logs', [AdminAuditLogController::class, 'index'])->name('audit.index');
        
        // Academic Resources management
        Route::get('/academic-resources', [AdminAcademicResourceController::class, 'index'])->name('academic-resources.index');
        Route::post('/academic-resources', [AdminAcademicResourceController::class, 'store'])->name('academic-resources.store');
        Route::get('/academic-resources/{resource}/edit', [AdminAcademicResourceController::class, 'edit'])->name('academic-resources.edit');
        Route::put('/academic-resources/{resource}', [AdminAcademicResourceController::class, 'update'])->name('academic-resources.update');
        Route::delete('/academic-resources/{resource}', [AdminAcademicResourceController::class, 'destroy'])->name('academic-resources.destroy');
        
        // Career Opportunities management
        Route::get('/career-opportunities', [AdminCareerOpportunityController::class, 'index'])->name('career-opportunities.index');
        Route::post('/career-opportunities', [AdminCareerOpportunityController::class, 'store'])->name('career-opportunities.store');
        Route::get('/career-opportunities/{opportunity}/edit', [AdminCareerOpportunityController::class, 'edit'])->name('career-opportunities.edit');
        Route::put('/career-opportunities/{opportunity}', [AdminCareerOpportunityController::class, 'update'])->name('career-opportunities.update');
        Route::delete('/career-opportunities/{opportunity}', [AdminCareerOpportunityController::class, 'destroy'])->name('career-opportunities.destroy');
        
        // Programs management
        Route::get('/programs', [AdminProgramController::class, 'index'])->name('programs.index');
        Route::post('/programs', [AdminProgramController::class, 'store'])->name('programs.store');
        Route::get('/programs/{program}/edit', [AdminProgramController::class, 'edit'])->name('programs.edit');
        Route::put('/programs/{program}', [AdminProgramController::class, 'update'])->name('programs.update');
        Route::delete('/programs/{program}', [AdminProgramController::class, 'destroy'])->name('programs.destroy');
        
        // Program courses management
        Route::get('/programs/{program}/courses', [AdminProgramController::class, 'courses'])->name('programs.courses');
        Route::post('/programs/{program}/courses', [AdminProgramController::class, 'addCourse'])->name('programs.add-course');
        Route::delete('/programs/{program}/courses/{programCourse}', [AdminProgramController::class, 'removeCourse'])->name('programs.remove-course');
        
        // Program outcomes management
        Route::get('/programs/{program}/outcomes', [AdminProgramController::class, 'outcomes'])->name('programs.outcomes');
        Route::post('/programs/{program}/outcomes', [AdminProgramController::class, 'addOutcome'])->name('programs.add-outcome');
        Route::delete('/programs/{program}/outcomes/{outcome}', [AdminProgramController::class, 'deleteOutcome'])->name('programs.delete-outcome');
        
        // Clubs management
        Route::get('/clubs', [AdminClubController::class, 'index'])->name('clubs.index');
        Route::post('/clubs', [AdminClubController::class, 'store'])->name('clubs.store');
        Route::get('/clubs/{club}/edit', [AdminClubController::class, 'edit'])->name('clubs.edit');
        Route::put('/clubs/{club}', [AdminClubController::class, 'update'])->name('clubs.update');
        Route::delete('/clubs/{club}', [AdminClubController::class, 'destroy'])->name('clubs.destroy');
        
        // Club members management
        Route::get('/clubs/{club}/members', [AdminClubController::class, 'members'])->name('clubs.members');
        Route::post('/clubs/{club}/members', [AdminClubController::class, 'addMember'])->name('clubs.add-member');
        Route::put('/clubs/{club}/members/{member}', [AdminClubController::class, 'updateMember'])->name('clubs.update-member');
        Route::delete('/clubs/{club}/members/{member}', [AdminClubController::class, 'removeMember'])->name('clubs.remove-member');
        
        // Club workshops management
        Route::get('/clubs/{club}/workshops', [AdminClubController::class, 'workshops'])->name('clubs.workshops');
        Route::post('/clubs/{club}/workshops', [AdminClubController::class, 'storeWorkshop'])->name('clubs.workshops.store');
        Route::put('/clubs/{club}/workshops/{workshop}', [AdminClubController::class, 'updateWorkshop'])->name('clubs.workshops.update');
        Route::delete('/clubs/{club}/workshops/{workshop}', [AdminClubController::class, 'destroyWorkshop'])->name('clubs.workshops.destroy');
        
        // Club events management
        Route::get('/clubs/{club}/events', [AdminClubController::class, 'events'])->name('clubs.events');
        Route::post('/clubs/{club}/events', [AdminClubController::class, 'storeEvent'])->name('clubs.events.store');
        Route::put('/clubs/{club}/events/{event}', [AdminClubController::class, 'updateEvent'])->name('clubs.events.update');
        Route::delete('/clubs/{club}/events/{event}', [AdminClubController::class, 'destroyEvent'])->name('clubs.events.destroy');
        
        // Batch management
        Route::get('/batches', [AdminBatchController::class, 'index'])->name('batches.index');
        Route::post('/batches', [AdminBatchController::class, 'store'])->name('batches.store');
        Route::delete('/batches/{batch}', [AdminBatchController::class, 'destroy'])->name('batches.destroy');
        
        // Student management
        Route::get('/students', [AdminStudentController::class, 'index'])->name('students.index');
        Route::post('/students', [AdminStudentController::class, 'store'])->name('students.store');
        Route::get('/students/{student}/edit', [AdminStudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/{student}', [AdminStudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [AdminStudentController::class, 'destroy'])->name('students.destroy');
        
        // Course management
        Route::get('/courses', [AdminCourseController::class, 'index'])->name('courses.index');
        Route::post('/courses', [AdminCourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('courses.destroy');
        
        // Result management
        Route::get('/results', [AdminResultController::class, 'index'])->name('results.index');
        Route::post('/results', [AdminResultController::class, 'store'])->name('results.store');
        Route::get('/results/{result}/edit', [AdminResultController::class, 'edit'])->name('results.edit');
        Route::put('/results/{result}', [AdminResultController::class, 'update'])->name('results.update');
        Route::delete('/results/{result}', [AdminResultController::class, 'destroy'])->name('results.destroy');
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

// Student authentication and dashboard routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [StudentAuthController::class, 'login']);
    Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');

    Route::middleware('student.auth')->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/courses', [StudentDashboardController::class, 'courses'])->name('courses');
        Route::put('/profile', [StudentDashboardController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [StudentDashboardController::class, 'changePassword'])->name('password.change');
    });
});
