<?php

namespace App\Http\Controllers;

use App\Models\CareerOpportunity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CareerOpportunityController extends Controller
{
    /**
     * Display career opportunities page
     */
    public function index(Request $request): View
    {
        $jobType = $request->input('job_type');
        
        $query = CareerOpportunity::active()->orderByDesc('created_at');
        
        if ($jobType) {
            $query->jobType($jobType);
        }
        
        $opportunities = $query->paginate(12);
        $jobTypes = CareerOpportunity::getJobTypes();
        
        return view('career-opportunities.index', compact('opportunities', 'jobTypes', 'jobType'));
    }

    /**
     * Display single opportunity
     */
    public function show(CareerOpportunity $opportunity): View
    {
        return view('career-opportunities.show', compact('opportunity'));
    }
}
