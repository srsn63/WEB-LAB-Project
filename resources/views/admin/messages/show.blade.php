<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message | KUET CSE Admin</title>
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
        .btn-outline-light {
            border-color: #ffffff;
            color: #ffffff;
            background: #000000;
        }
        .btn-outline-light:hover {
            background: #333333;
            color: #ffffff;
        }
        .message-header {
            border-bottom: 1px solid #333333;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        .message-body {
            line-height: 1.8;
            white-space: pre-wrap;
        }
        .info-item {
            margin-bottom: 0.75rem;
        }
        .info-label {
            color: #cccccc;
            font-size: 0.9rem;
            display: inline-block;
            min-width: 80px;
        }
        .info-value {
            color: #ffffff;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand fw-semibold">KUET CSE Admin</span>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-light btn-sm">Back to Messages</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-glass p-4">
                <div class="message-header">
                    <h2 class="h4 mb-3">Contact Message</h2>
                    <div class="info-item">
                        <span class="info-label">From:</span>
                        <span class="info-value fw-bold">{{ $message->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <a href="mailto:{{ $message->email }}" class="info-value text-decoration-none" style="color: #38bdf8;">{{ $message->email }}</a>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Received:</span>
                        <span class="info-value">{{ $message->created_at->format('F d, Y \a\t h:i A') }}</span>
                        <span class="text-muted">({{ $message->created_at->diffForHumans() }})</span>
                    </div>
                </div>

                <div class="message-body">
                    <h5 class="mb-3">Message:</h5>
                    <p style="color: #f0f0f0;">{{ $message->message }}</p>
                </div>

                <div class="d-flex justify-content-between mt-4 pt-3" style="border-top: 1px solid #333333;">
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-light">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="display: inline-block; margin-right: 4px;">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                        </svg>
                        Back to All Messages
                    </a>
                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
