<?php

namespace App\Http\Controllers;

use App\Models\AcademicResource;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AcademicResourceController extends Controller
{
    /**
     * Display the academic resources page with all categories
     */
    public function index(Request $request): View
    {
        // Get all batches sorted descending (newest first)
        $batches = Batch::sorted('desc')->get();

        // Get selected batch from request or default to latest batch
        $selectedBatchId = $request->input('batch_id', $batches->first()?->id);
        $selectedBatch = Batch::find($selectedBatchId);

        // Get selected semester from request
        $selectedSemester = $request->input('semester');

        // Available semesters
        $semesters = ['1-1', '1-2', '2-1', '2-2', '3-1', '3-2', '4-1', '4-2'];

        // Build query for resources
        $courseMaterialsQuery = AcademicResource::active()
            ->where('batch_id', $selectedBatchId)
            ->category('course_material');
        
        $syllabiQuery = AcademicResource::active()
            ->where('batch_id', $selectedBatchId)
            ->category('syllabus');
        
        $academicCalendarsQuery = AcademicResource::active()
            ->where('batch_id', $selectedBatchId)
            ->category('academic_calendar');

        // Apply semester filter if selected
        if ($selectedSemester) {
            $courseMaterialsQuery->where('semester', $selectedSemester);
            $syllabiQuery->where('semester', $selectedSemester);
            $academicCalendarsQuery->where('semester', $selectedSemester);
        }

        // Get results
        $courseMaterials = $courseMaterialsQuery->orderByDesc('created_at')->get();
        $syllabi = $syllabiQuery->orderByDesc('created_at')->get();
        $academicCalendars = $academicCalendarsQuery->orderByDesc('created_at')->get();

        return view('academic-resources.index', compact(
            'courseMaterials', 
            'syllabi', 
            'academicCalendars', 
            'batches', 
            'selectedBatch',
            'semesters',
            'selectedSemester'
        ));
    }
}
