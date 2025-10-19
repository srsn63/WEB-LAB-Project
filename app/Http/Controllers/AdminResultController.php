<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\StudentResult;
use App\Services\AuditLogger;
use Illuminate\Http\Request;

class AdminResultController extends Controller
{
    /**
     * Display results management page
     */
    public function index(Request $request)
    {
        $semester = $request->input('semester', '1-1');
        $studentId = $request->input('student_id');
        
        $semesters = Course::getSemesters();
        $students = Student::where('is_active', true)
            ->orderBy('student_id')
            ->get();
        
        $query = StudentResult::with(['student', 'course'])
            ->where('semester', $semester);
        
        if ($studentId) {
            $query->where('student_id', $studentId);
        }
        
        $results = $query->orderBy('student_id')
            ->orderBy('course_id')
            ->get();
        
        $courses = Course::forSemester($semester)->get();
        
        return view('admin.results.index', compact('results', 'semesters', 'semester', 'students', 'studentId', 'courses'));
    }

    /**
     * Store a new result
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,student_id',
            'course_id' => 'required|exists:courses,id',
            'semester' => 'required|in:1-1,1-2,2-1,2-2,3-1,3-2,4-1,4-2',
            'exam_type' => 'required|in:midterm,final,quiz,assignment,project',
            'marks_obtained' => 'required|numeric|min:0',
            'total_marks' => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);
        
        // Calculate percentage and grade
        $percentage = ($validated['marks_obtained'] / $validated['total_marks']) * 100;
        $gradeData = StudentResult::calculateGrade($percentage);
        
        $validated['grade'] = $gradeData['grade'];
        $validated['grade_point'] = $gradeData['point'];
        
        $result = StudentResult::create($validated);
        
        // Audit log
        $student = Student::where('student_id', $validated['student_id'])->first();
        $course = Course::find($validated['course_id']);
        AuditLogger::log($request, 'created', 'StudentResult', $result->id, 
            $student->name . ' - ' . $course->course_code . ' (' . $validated['exam_type'] . ')', null);
        
        return redirect()->route('admin.results.index', ['semester' => $validated['semester']])
            ->with('status', 'Result added successfully!');
    }

    /**
     * Show edit form
     */
    public function edit(StudentResult $result)
    {
        $semesters = Course::getSemesters();
        $students = Student::where('is_active', true)->get();
        $courses = Course::forSemester($result->semester)->get();
        $examTypes = StudentResult::getExamTypes();
        
        return view('admin.results.edit', compact('result', 'semesters', 'students', 'courses', 'examTypes'));
    }

    /**
     * Update result
     */
    public function update(Request $request, StudentResult $result)
    {
        $validated = $request->validate([
            'marks_obtained' => 'required|numeric|min:0',
            'total_marks' => 'required|numeric|min:0',
            'exam_type' => 'required|in:midterm,final,quiz,assignment,project',
            'remarks' => 'nullable|string',
        ]);
        
        $oldData = $result->toArray();
        
        // Calculate percentage and grade
        $percentage = ($validated['marks_obtained'] / $validated['total_marks']) * 100;
        $gradeData = StudentResult::calculateGrade($percentage);
        
        $validated['grade'] = $gradeData['grade'];
        $validated['grade_point'] = $gradeData['point'];
        
        $result->update($validated);
        
        // Track changes
        $changed = [];
        foreach ($validated as $key => $value) {
            if (isset($oldData[$key]) && $oldData[$key] != $value) {
                $changed[$key] = ['before' => $oldData[$key], 'after' => $value];
            }
        }
        
        // Audit log
        AuditLogger::log($request, 'updated', 'StudentResult', $result->id, 
            $result->student->name . ' - ' . $result->course->course_code, $changed);
        
        return redirect()->route('admin.results.index', ['semester' => $result->semester])
            ->with('status', 'Result updated successfully!');
    }

    /**
     * Delete result
     */
    public function destroy(StudentResult $result)
    {
        $semester = $result->semester;
        $resultName = $result->student->name . ' - ' . $result->course->course_code . ' (' . $result->exam_type . ')';
        
        // Audit log
        AuditLogger::log(request(), 'deleted', 'StudentResult', $result->id, $resultName, null);
        
        $result->delete();
        
        return redirect()->route('admin.results.index', ['semester' => $semester])
            ->with('status', 'Result deleted successfully!');
    }
}
