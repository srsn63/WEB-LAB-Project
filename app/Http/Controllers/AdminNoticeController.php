<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\AuditLogger;

class AdminNoticeController extends Controller
{
    /**
     * Store a newly created notice.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

    $notice = Notice::create($data);
    AuditLogger::log($request, 'created', 'Notice', $notice->id, $notice->title, null);

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Notice published successfully.');
    }

    /**
     * Show the form for editing a notice.
     */
    public function edit(Notice $notice): View
    {
        return view('admin.notices.edit', compact('notice'));
    }

    /**
     * Update the specified notice.
     */
    public function update(Request $request, Notice $notice): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $before = $notice->getOriginal();
        $notice->update($data);
        $after = $notice->fresh()->toArray();
        $changed = [];
        foreach ($data as $k => $v) {
            $prev = $before[$k] ?? null;
            $next = $after[$k] ?? null;
            if ($prev != $next) {
                $changed[$k] = ['before' => $prev, 'after' => $next];
            }
        }
        AuditLogger::log($request, 'updated', 'Notice', $notice->id, $notice->title, $changed);

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Notice updated successfully.');
    }

    /**
     * Remove the specified notice.
     */
    public function destroy(Notice $notice): RedirectResponse
    {
    $noticeTitle = $notice->title;
    AuditLogger::log(request(), 'deleted', 'Notice', $notice->id, $noticeTitle, null);
        $notice->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('status', "Notice '{$noticeTitle}' has been deleted.");
    }
}
