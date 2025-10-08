<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\View\View;

class NoticeController extends Controller
{
    /**
     * Display the specified notice.
     */
    public function show(Notice $notice): View
    {
        return view('notices.show', compact('notice'));
    }

    /**
     * Display a listing of all notices.
     */
    public function index(): View
    {
        $notices = Notice::orderByDesc('created_at')->paginate(10);
        return view('notices.index', compact('notices'));
    }
}
