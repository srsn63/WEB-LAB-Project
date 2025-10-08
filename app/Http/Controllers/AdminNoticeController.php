<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

        Notice::create($data);

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

        $notice->update($data);

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
        $notice->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('status', "Notice '{$noticeTitle}' has been deleted.");
    }
}
