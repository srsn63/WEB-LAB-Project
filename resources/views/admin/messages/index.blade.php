<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages | KUET CSE Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #000000 !important;
            min-height: 100vh;
            color: #ffffff !important;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: #000000 !important;
            border-bottom: 1px solid #333333;
        }
        .card-glass {
            background: #000000 !important;
            border: 2px solid #333333;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            font-weight: 600;
        }
        .btn-primary:hover, .btn-primary:focus {
            filter: brightness(1.05);
            box-shadow: 0 6px 18px rgba(56,189,248,0.15);
        }
        .btn-outline-light {
            border-color: #ffffff;
            color: #ffffff;
            background: #000000;
        }
        .btn-outline-light:hover {
            background: #333333;
            color: #ffffff;
        }
        .message-item {
            background: #000000 !important;
            border: 1px solid #333333;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }
        .message-item:hover {
            border-color: #555555;
            transform: translateY(-2px);
        }
        .message-item.unread {
            border-color: #38bdf8;
            background: rgba(56, 189, 248, 0.05) !important;
        }
        .badge-unread {
            background: #38bdf8;
            color: #000000;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
        }
        .text-muted {
            color: #cccccc !important;
        }
        .pagination .page-link {
            background: #000000;
            border-color: #333333;
            color: #ffffff;
        }
        .pagination .page-link:hover {
            background: #333333;
            border-color: #555555;
            color: #ffffff;
        }
        .pagination .page-item.active .page-link {
            background: #38bdf8;
            border-color: #38bdf8;
            color: #000000;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand fw-semibold">KUET CSE Admin</span>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">Back to Dashboard</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    @if(session('status'))
        <div class="alert alert-success mb-4" style="background: #000000; border: 2px solid #38bdf8; color: #ffffff;">
            {{ session('status') }}
        </div>
    @endif

    <div class="card-glass p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 mb-0">Contact Messages</h2>
            <span class="badge bg-secondary">{{ $messages->total() }} Total Messages</span>
        </div>

        @forelse($messages as $message)
            <div class="message-item {{ !$message->is_read ? 'unread' : '' }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <strong class="h6 mb-0">{{ $message->name }}</strong>
                            @if(!$message->is_read)
                                <span class="badge badge-unread">NEW</span>
                            @endif
                        </div>
                        <p class="text-muted mb-2">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="display: inline-block; margin-right: 4px;">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                            </svg>
                            {{ $message->email }}
                        </p>
                        <p class="mb-2" style="color: #f0f0f0;">{{ Str::limit($message->message, 150) }}</p>
                        <small class="text-muted">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="display: inline-block; margin-right: 4px;">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                            </svg>
                            {{ $message->created_at->format('M d, Y h:i A') }} 
                            ({{ $message->created_at->diffForHumans() }})
                        </small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-sm btn-primary">Read</a>
                        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <p class="text-muted">No contact messages yet.</p>
            </div>
        @endforelse

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
</body>
</html>
