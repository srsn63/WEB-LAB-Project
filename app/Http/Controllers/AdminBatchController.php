<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminBatchController extends Controller
{
    /**
     * Display batches management page
     */
    public function index(): View
    {
        $batches = Batch::sorted('desc')->get();
        return view('admin.batches.index', compact('batches'));
    }

    /**
     * Store a new batch
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:20', 'unique:batches,name', 'regex:/^2k\d{2}$/i'],
        ], [
            'name.regex' => 'Batch name must be in the format 2kXX (e.g., 2k21, 2k22)',
        ]);

        // Extract sort order from the name
        $data['sort_order'] = Batch::extractSortOrder($data['name']);

        $batch = Batch::create($data);

        AuditLogger::log($request, 'created', 'Batch', $batch->id, $batch->name, null);

        return redirect()
            ->route('admin.batches.index')
            ->with('status', 'Batch added successfully.');
    }

    /**
     * Delete a batch
     */
    public function destroy(Batch $batch): RedirectResponse
    {
        // Check if batch has resources
        $resourceCount = $batch->academicResources()->count();
        
        if ($resourceCount > 0) {
            return redirect()
                ->route('admin.batches.index')
                ->with('error', "Cannot delete batch {$batch->name}. It has {$resourceCount} associated resources.");
        }

        $name = $batch->name;
        $batch->delete();

        AuditLogger::log(request(), 'deleted', 'Batch', $batch->id, $name, null);

        return redirect()
            ->route('admin.batches.index')
            ->with('status', 'Batch deleted successfully.');
    }
}
