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

        // Get resources for the selected batch
        $courseMaterials = AcademicResource::active()
            ->where('batch_id', $selectedBatchId)
            ->category('course_material')
            ->orderByDesc('created_at')
            ->get();

        $syllabi = AcademicResource::active()
            ->where('batch_id', $selectedBatchId)
            ->category('syllabus')
            ->orderByDesc('created_at')
            ->get();

        $academicCalendars = AcademicResource::active()
            ->where('batch_id', $selectedBatchId)
            ->category('academic_calendar')
            ->orderByDesc('created_at')
            ->get();

        return view('academic-resources.index', compact(
            'courseMaterials', 
            'syllabi', 
            'academicCalendars', 
            'batches', 
            'selectedBatch'
        ));
    }
}
