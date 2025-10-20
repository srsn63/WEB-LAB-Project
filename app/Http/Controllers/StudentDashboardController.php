<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudentResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\AuditLogger;

class StudentDashboardController extends Controller
{
    /**
     * Show student dashboard
     */
    public function index()
    {
        $student = Auth::guard('student')->user();
        
        // Get latest 5 results for current semester
        $recentResults = StudentResult::forStudent($student->student_id)
            ->forSemester($student->current_semester)
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Calculate semester GPA
        $semesterResults = StudentResult::forStudent($student->student_id)
            ->forSemester($student->current_semester)
            ->where('exam_type', 'final')
            ->get();
        
        $semesterGPA = 0;
        if ($semesterResults->count() > 0) {
            $totalPoints = $semesterResults->sum('grade_point');
            $semesterGPA = round($totalPoints / $semesterResults->count(), 2);
        }
        
        return view('student.dashboard', compact('student', 'recentResults', 'semesterGPA'));
    }

    /**
     * Show student courses based on their semester
     */
    public function courses(Request $request)
    {
        $student = Auth::guard('student')->user();
        
        // Get selected semester from query parameter, default to current semester
        $selectedSemester = $request->query('semester', $student->current_semester);
        
        // Get all available semesters
        $semesters = ['1-1', '1-2', '2-1', '2-2', '3-1', '3-2', '4-1', '4-2'];
        
        $courses = Course::forSemester($selectedSemester)
            ->orderBy('course_code')
            ->get();
        
        // Get results for each course
        $courseResults = [];
        foreach ($courses as $course) {
            $courseResults[$course->id] = StudentResult::forStudent($student->student_id)
                ->where('course_id', $course->id)
                ->where('semester', $selectedSemester)
                ->get();
        }
        
        return view('student.courses', compact('student', 'courses', 'courseResults', 'selectedSemester', 'semesters'));
    }

    /**
     * Update student profile
     */
    public function updateProfile(Request $request)
    {
        $student = Auth::guard('student')->user();

        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|url',
        ]);

        $before = $student->getOriginal();
        $student->update($validated);
        $after = $student->fresh()->toArray();

        // Track changes for audit
        $changed = [];
        foreach ($validated as $k => $v) {
            $prev = $before[$k] ?? null;
            $next = $after[$k] ?? null;
            if ($prev != $next) {
                $changed[$k] = ['before' => $prev, 'after' => $next];
            }
        }

        if (!empty($changed)) {
            AuditLogger::log($request, 'updated', 'Student', $student->id, $student->name, $changed);
        }

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Change student password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $student = Auth::guard('student')->user();

        if (!Hash::check($request->current_password, $student->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $student->update([
            'password' => Hash::make($request->new_password),
        ]);

        AuditLogger::log($request, 'updated', 'Student', $student->id, $student->name, ['password' => ['before' => '******', 'after' => '******']]);

        return back()->with('success', 'Password changed successfully!');
    }
}
