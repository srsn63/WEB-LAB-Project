<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $notice->title }} | KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(160deg, #020617 0%, #0f172a 45%, #1e293b 100%);
            min-height: 100vh;
            color: #e2e8f0;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: rgba(15, 23, 42, 0.9) !important;
            border-bottom: 1px solid rgba(148, 163, 184, 0.25);
        }
        .navbar-brand img {
            height: 40px;
        }
        .card-glass {
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 24px;
            box-shadow: 0 24px 80px rgba(30, 64, 175, 0.35);
        }
        .btn-outline-light {
            border-color: rgba(148, 163, 184, 0.4);
            color: #e2e8f0;
        }
        .btn-outline-light:hover {
            color: #020617;
            background-color: #e2e8f0;
        }
        .notice-meta {
            color: #94a3b8;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.2);
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .notice-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #f1f5f9;
        }
        .notice-content p {
            margin-bottom: 1.5rem;
        }
        .back-link {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 500;
        }
        .back-link:hover {
            color: #0ea5e9;
            text-decoration: underline;
        }
        .page-header {
            background: rgba(30, 64, 175, 0.1);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }
        .breadcrumb {
            background: none;
            margin-bottom: 0;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #64748b;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('KUET_CSE.png') }}" alt="KUET CSE" class="me-2">
            KUET CSE
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">Back to Home</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="back-link">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('notices.index') }}" class="back-link">Notices</a></li>
                        <li class="breadcrumb-item active text-secondary" aria-current="page">{{ $notice->title }}</li>
                    </ol>
                </nav>
                <h1 class="display-6 fw-bold mb-0">{{ $notice->title }}</h1>
            </div>

            <div class="card card-glass">
                <div class="card-body p-4">
                    <div class="notice-meta">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Published:</strong> {{ $notice->created_at->format('F d, Y \a\t g:i A') }}
                            </div>
                            @if($notice->updated_at->gt($notice->created_at))
                                <div>
                                    <small><strong>Last Updated:</strong> {{ $notice->updated_at->format('F d, Y \a\t g:i A') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="notice-content">
                        {!! nl2br(e($notice->content)) !!}
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('notices.index') }}" class="back-link">
                    ← Back to All Notices
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>