<?php

namespace App\Http\Controllers;

use App\Models\AcademicResource;
use Illuminate\View\View;

class AcademicResourceController extends Controller
{
    /**
     * Display the academic resources page with all categories
     */
    public function index(): View
    {
        $courseMaterials = AcademicResource::active()
            ->category('course_material')
            ->orderByDesc('created_at')
            ->get();

        $syllabi = AcademicResource::active()
            ->category('syllabus')
            ->orderByDesc('created_at')
            ->get();

        $academicCalendars = AcademicResource::active()
            ->category('academic_calendar')
            ->orderByDesc('created_at')
            ->get();

        return view('academic-resources.index', compact('courseMaterials', 'syllabi', 'academicCalendars'));
    }
}
