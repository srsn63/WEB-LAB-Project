<?php

namespace App\Http\Controllers;

use App\Models\CareerOpportunity;
use App\Services\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCareerOpportunityController extends Controller
{
    /**
     * Display list of career opportunities
     */
    public function index(): View
    {
        $opportunities = CareerOpportunity::orderByDesc('created_at')->paginate(15);
        $jobTypes = CareerOpportunity::getJobTypes();
        
        return view('admin.career-opportunities.index', compact('opportunities', 'jobTypes'));
    }

    /**
     * Store a new career opportunity
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'job_type' => ['required', 'string', 'in:internship,full-time,part-time'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'salary_range' => ['nullable', 'string', 'max:100'],
            'deadline' => ['nullable', 'date'],
            'application_link' => ['nullable', 'url'],
            'contact_email' => ['nullable', 'email'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $opportunity = CareerOpportunity::create($data);

        AuditLogger::log($request, 'created', 'CareerOpportunity', $opportunity->id, $opportunity->title, null);

        return redirect()
            ->route('admin.career-opportunities.index')
            ->with('status', 'Career opportunity added successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(CareerOpportunity $opportunity): View
    {
        $jobTypes = CareerOpportunity::getJobTypes();
        return view('admin.career-opportunities.edit', compact('opportunity', 'jobTypes'));
    }

    /**
     * Update career opportunity
     */
    public function update(Request $request, CareerOpportunity $opportunity): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'job_type' => ['required', 'string', 'in:internship,full-time,part-time'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'salary_range' => ['nullable', 'string', 'max:100'],
            'deadline' => ['nullable', 'date'],
            'application_link' => ['nullable', 'url'],
            'contact_email' => ['nullable', 'email'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $before = $opportunity->getOriginal();
        $opportunity->update($data);
        $after = $opportunity->fresh()->toArray();

        $changed = [];
        foreach ($data as $k => $v) {
            $prev = $before[$k] ?? null;
            $next = $after[$k] ?? null;
            if ($prev != $next) {
                $changed[$k] = ['before' => $prev, 'after' => $next];
            }
        }

        AuditLogger::log($request, 'updated', 'CareerOpportunity', $opportunity->id, $opportunity->title, $changed);

        return redirect()
            ->route('admin.career-opportunities.index')
            ->with('status', 'Career opportunity updated successfully.');
    }

    /**
     * Delete career opportunity
     */
    public function destroy(CareerOpportunity $opportunity): RedirectResponse
    {
        $title = $opportunity->title;
        AuditLogger::log(request(), 'deleted', 'CareerOpportunity', $opportunity->id, $title, null);
        $opportunity->delete();

        return redirect()
            ->route('admin.career-opportunities.index')
            ->with('status', "Career opportunity '{$title}' has been deleted.");
    }
}
