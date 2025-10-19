<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index(Request $request)
    {
        $semester = $request->input('semester', '1-1');
        $semesters = Course::getSemesters();
        
        $courses = Course::forSemester($semester)
            ->orderBy('course_code')
            ->get();

        return view('admin.courses.index', compact('courses', 'semesters', 'semester'));
    }

    /**
     * Store a newly created course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'semester' => 'required|in:1-1,1-2,2-1,2-2,3-1,3-2,4-1,4-2',
            'course_code' => 'required|string|unique:courses,course_code|max:20',
            'course_name' => 'required|string|max:255',
            'credits' => 'required|numeric|min:0|max:10',
            'description' => 'nullable|string',
        ]);

        $course = Course::create($validated);

        // Audit log
        AuditLogger::log($request, 'created', 'Course', $course->id, $course->course_code . ' - ' . $course->course_name, null);

        return redirect()->route('admin.courses.index', ['semester' => $validated['semester']])
            ->with('status', 'Course added successfully!');
    }

    /**
     * Show the form for editing the specified course
     */
    public function edit(Course $course)
    {
        $semesters = Course::getSemesters();
        return view('admin.courses.edit', compact('course', 'semesters'));
    }

    /**
     * Update the specified course
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'semester' => 'required|in:1-1,1-2,2-1,2-2,3-1,3-2,4-1,4-2',
            'course_code' => 'required|string|max:20|unique:courses,course_code,' . $course->id,
            'course_name' => 'required|string|max:255',
            'credits' => 'required|numeric|min:0|max:10',
            'description' => 'nullable|string',
        ]);

        $oldData = $course->toArray();
        $course->update($validated);

        // Track changes
        $changed = [];
        foreach ($validated as $key => $value) {
            if (isset($oldData[$key]) && $oldData[$key] != $value) {
                $changed[$key] = ['before' => $oldData[$key], 'after' => $value];
            }
        }

        // Audit log
        AuditLogger::log($request, 'updated', 'Course', $course->id, $course->course_code . ' - ' . $course->course_name, $changed);

        return redirect()->route('admin.courses.index', ['semester' => $validated['semester']])
            ->with('status', 'Course updated successfully!');
    }

    /**
     * Remove the specified course
     */
    public function destroy(Course $course)
    {
        $semester = $course->semester;
        $courseName = $course->course_code . ' - ' . $course->course_name;
        
        // Audit log
        AuditLogger::log(request(), 'deleted', 'Course', $course->id, $courseName, null);

        $course->delete();

        return redirect()->route('admin.courses.index', ['semester' => $semester])
            ->with('status', 'Course deleted successfully!');
    }
}
