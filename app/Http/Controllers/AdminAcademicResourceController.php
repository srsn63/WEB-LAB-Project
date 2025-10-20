<?php

namespace App\Http\Controllers;

use App\Models\AcademicResource;
use App\Models\Batch;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminAcademicResourceController extends Controller
{
    /**
     * Display academic resources in admin panel
     */
    public function index(): View
    {
        $resources = AcademicResource::with('batch')->orderByDesc('created_at')->paginate(15);
        $batches = Batch::sorted('desc')->get();
        return view('admin.academic-resources.index', compact('resources', 'batches'));
    }

    /**
     * Store a new academic resource
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'batch_id' => ['required', 'exists:batches,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:course_material,syllabus,academic_calendar,class_routine'],
            'description' => ['nullable', 'string'],
            'file_url' => ['nullable', 'url'],
            'course_code' => ['nullable', 'string', 'max:50'],
            'semester' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $resource = AcademicResource::create($data);

        AuditLogger::log($request, 'created', 'AcademicResource', $resource->id, $resource->title, null);

        return redirect()
            ->route('admin.academic-resources.index')
            ->with('status', 'Academic resource added successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(AcademicResource $resource): View
    {
        $batches = Batch::sorted('desc')->get();
        return view('admin.academic-resources.edit', compact('resource', 'batches'));
    }

    /**
     * Update an academic resource
     */
    public function update(Request $request, AcademicResource $resource): RedirectResponse
    {
        $data = $request->validate([
            'batch_id' => ['required', 'exists:batches,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:course_material,syllabus,academic_calendar,class_routine'],
            'description' => ['nullable', 'string'],
            'file_url' => ['nullable', 'url'],
            'course_code' => ['nullable', 'string', 'max:50'],
            'semester' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $before = $resource->getOriginal();
        $resource->update($data);
        $after = $resource->fresh()->toArray();

        $changed = [];
        foreach ($data as $k => $v) {
            $prev = $before[$k] ?? null;
            $next = $after[$k] ?? null;
            if ($prev != $next) {
                $changed[$k] = ['before' => $prev, 'after' => $next];
            }
        }

        AuditLogger::log($request, 'updated', 'AcademicResource', $resource->id, $resource->title, $changed);

        return redirect()
            ->route('admin.academic-resources.index')
            ->with('status', 'Academic resource updated successfully.');
    }

    /**
     * Delete an academic resource
     */
    public function destroy(AcademicResource $resource): RedirectResponse
    {
        $title = $resource->title;
        AuditLogger::log(request(), 'deleted', 'AcademicResource', $resource->id, $title, null);
        $resource->delete();

        return redirect()
            ->route('admin.academic-resources.index')
            ->with('status', "Academic resource '{$title}' has been deleted.");
    }
}
