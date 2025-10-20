<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::query()->active()->with('coordinator');

        // Filter by degree type if provided
        if ($request->has('degree_type') && in_array($request->degree_type, ['undergraduate', 'postgraduate'])) {
            $query->where('degree_type', $request->degree_type);
        }

        $programs = $query->ordered()->get();

        $degreeTypes = [
            'undergraduate' => 'Undergraduate',
            'postgraduate' => 'Postgraduate',
        ];

        return view('programs.index', compact('programs', 'degreeTypes'));
    }

    public function show(Program $program)
    {
        // Eager load relationships
        $program->load([
            'coordinator',
            'outcomes' => function($query) {
                $query->orderBy('order');
            }
        ]);

        // Get courses grouped by year and semester
        $coursesByYearSemester = [];
        $creditsByYear = [];
        
        for ($year = 1; $year <= 4; $year++) {
            $yearCredits = 0;
            for ($semester = 1; $semester <= 2; $semester++) {
                $semesterKey = "{$year}-{$semester}";
                $courses = $program->programCourses()
                    ->where('year', $year)
                    ->where('semester', $semester)
                    ->with('course')
                    ->get();
                
                $coursesByYearSemester[$semesterKey] = $courses;
                
                // Calculate semester credits
                $semesterCredits = $courses->sum(function($pc) {
                    return $pc->course->credits ?? 0;
                });
                $yearCredits += $semesterCredits;
            }
            $creditsByYear[$year] = $yearCredits;
        }

        // Calculate mandatory vs elective credits
        $mandatoryCredits = $program->programCourses()
            ->where('is_mandatory', true)
            ->with('course')
            ->get()
            ->sum(function($pc) {
                return $pc->course->credits ?? 0;
            });

        $electiveCredits = $program->total_credits - $mandatoryCredits;

        return view('programs.show', compact(
            'program',
            'coursesByYearSemester',
            'creditsByYear',
            'mandatoryCredits',
            'electiveCredits'
        ));
    }
}
