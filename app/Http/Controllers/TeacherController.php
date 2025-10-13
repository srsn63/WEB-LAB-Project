<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a beautifully themed collection of teacher cards.
     */
    public function index(): View
    {
        $teachers = Teacher::ordered()->get();

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show a single teacher dashboard inspired by the KUET CSE profile layout.
     */
    public function show(Teacher $teacher): View
    {
        return view('teachers.show', compact('teacher'));
    }
}
