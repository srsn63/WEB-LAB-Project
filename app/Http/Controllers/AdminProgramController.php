<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramOutcome;
use App\Models\Teacher;
use App\Services\AuditLogger;
use Illuminate\Http\Request;

class AdminProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('coordinator')
            ->orderBy('order')
            ->orderBy('name')
            ->paginate(15);
        
        $teachers = Teacher::select('id', 'name')->orderBy('name')->get();
        $degreeTypes = [
            'undergraduate' => 'Undergraduate',
            'postgraduate' => 'Postgraduate',
        ];

        return view('admin.programs.index', compact('programs', 'teachers', 'degreeTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_name' => ['required', 'string', 'max:50'],
            'degree_type' => ['required', 'in:undergraduate,postgraduate'],
            'duration' => ['required', 'string', 'max:50'],
            'total_credits' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string'],
            'objectives' => ['nullable', 'string'],
            'career_prospects' => ['nullable', 'string'],
            'admission_requirements' => ['nullable', 'string'],
            'program_coordinator_id' => ['nullable', 'exists:teachers,id'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $program = Program::create($validated);

        AuditLogger::log(
            $request,
            'program_created',
            'Program',
            $program->id,
            "Created program: {$program->name}",
            $validated
        );

        return redirect()->route('admin.programs.index')
            ->with('status', "Program '{$program->name}' created successfully!");
    }

    public function edit(Program $program)
    {
        $program->load('coordinator');
        $teachers = Teacher::select('id', 'name')->orderBy('name')->get();
        $degreeTypes = [
            'undergraduate' => 'Undergraduate',
            'postgraduate' => 'Postgraduate',
        ];

        return view('admin.programs.edit', compact('program', 'teachers', 'degreeTypes'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_name' => ['required', 'string', 'max:50'],
            'degree_type' => ['required', 'in:undergraduate,postgraduate'],
            'duration' => ['required', 'string', 'max:50'],
            'total_credits' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string'],
            'objectives' => ['nullable', 'string'],
            'career_prospects' => ['nullable', 'string'],
            'admission_requirements' => ['nullable', 'string'],
            'program_coordinator_id' => ['nullable', 'exists:teachers,id'],
            'is_active' => ['boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $oldData = $program->toArray();
        $program->update($validated);

        // Track changes
        $changes = [];
        foreach ($validated as $key => $value) {
            if (isset($oldData[$key]) && $oldData[$key] != $value) {
                $changes[$key] = ['old' => $oldData[$key], 'new' => $value];
            }
        }

        if (!empty($changes)) {
            AuditLogger::log(
                $request,
                'program_updated',
                'Program',
                $program->id,
                "Updated program: {$program->name}",
                $changes
            );
        }

        return redirect()->route('admin.programs.index')
            ->with('status', "Program '{$program->name}' updated successfully!");
    }

    public function destroy(Request $request, Program $program)
    {
        $programName = $program->name;
        $programId = $program->id;

        AuditLogger::log(
            $request,
            'program_deleted',
            'Program',
            $programId,
            "Deleted program: {$programName}",
            $program->toArray()
        );

        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('status', "Program '{$programName}' deleted successfully!");
    }

    // Manage program courses
    public function courses(Request $request, Program $program)
    {
        $program->load(['programCourses.course']);
        
        // Get all available courses
        $availableCourses = \App\Models\Course::select('id', 'course_code', 'course_name', 'credits')
            ->orderBy('course_code')
            ->get();

        // Group program courses by year and semester
        $coursesByYearSemester = [];
        for ($year = 1; $year <= 4; $year++) {
            for ($semester = 1; $semester <= 2; $semester++) {
                $coursesByYearSemester[$year][$semester] = $program->programCourses()
                    ->where('year', $year)
                    ->where('semester', $semester)
                    ->with('course')
                    ->get();
            }
        }

        // Define semester tabs
        $semesters = [
            'all' => 'All Courses',
            '1-1' => 'Year 1 - Semester 1',
            '1-2' => 'Year 1 - Semester 2',
            '2-1' => 'Year 2 - Semester 1',
            '2-2' => 'Year 2 - Semester 2',
            '3-1' => 'Year 3 - Semester 1',
            '3-2' => 'Year 3 - Semester 2',
            '4-1' => 'Year 4 - Semester 1',
            '4-2' => 'Year 4 - Semester 2',
        ];

        // Get selected semester filter from request
        $selectedSemester = $request->get('filter', 'all');

        return view('admin.programs.courses', compact('program', 'availableCourses', 'coursesByYearSemester', 'semesters', 'selectedSemester'));
    }

    // Add course to program
    public function addCourse(Request $request, Program $program)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'year' => ['required', 'integer', 'min:1', 'max:4'],
            'semester' => ['required', 'integer', 'min:1', 'max:2'],
            'is_mandatory' => ['boolean'],
        ]);

        $validated['is_mandatory'] = $request->has('is_mandatory');

        // Check if course already assigned to this program
        $exists = $program->programCourses()
            ->where('course_id', $validated['course_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'This course is already assigned to this program!');
        }

        $programCourse = $program->programCourses()->create($validated);

        $course = \App\Models\Course::find($validated['course_id']);

        AuditLogger::log(
            $request,
            'program_course_added',
            'Program',
            $program->id,
            "Added course {$course->course_code} to program {$program->name} (Year {$validated['year']}, Semester {$validated['semester']})",
            $validated
        );

        return back()->with('status', "Course '{$course->course_code}' added successfully!");
    }

    // Remove course from program
    public function removeCourse(Request $request, Program $program, $programCourseId)
    {
        $programCourse = $program->programCourses()->findOrFail($programCourseId);
        $course = $programCourse->course;

        AuditLogger::log(
            $request,
            'program_course_removed',
            'Program',
            $program->id,
            "Removed course {$course->course_code} from program {$program->name}",
            $programCourse->toArray()
        );

        $programCourse->delete();

        return back()->with('status', "Course '{$course->course_code}' removed successfully!");
    }

    // Manage program outcomes
    public function outcomes(Program $program)
    {
        $program->load('outcomes');
        return view('admin.programs.outcomes', compact('program'));
    }

    // Add program outcome
    public function addOutcome(Request $request, Program $program)
    {
        $validated = $request->validate([
            'outcome_text' => ['required', 'string'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['order'] = $validated['order'] ?? ($program->outcomes()->max('order') + 1);

        $outcome = $program->outcomes()->create($validated);

        AuditLogger::log(
            $request,
            'program_outcome_added',
            'Program',
            $program->id,
            "Added outcome to program {$program->name}",
            $validated
        );

        return back()->with('status', 'Program outcome added successfully!');
    }

    // Delete program outcome
    public function deleteOutcome(Request $request, Program $program, ProgramOutcome $outcome)
    {
        AuditLogger::log(
            $request,
            'program_outcome_deleted',
            'Program',
            $program->id,
            "Deleted outcome from program {$program->name}",
            $outcome->toArray()
        );

        $outcome->delete();

        return back()->with('status', 'Program outcome deleted successfully!');
    }
}
