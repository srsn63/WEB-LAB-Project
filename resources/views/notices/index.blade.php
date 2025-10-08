<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Notices | KUET CSE</title>
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
        .notice-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        .notice-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.15);
            border-color: rgba(59, 130, 246, 0.3);
        }
        .notice-meta {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .notice-title {
            color: #f1f5f9;
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        .notice-preview {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        .read-more-link {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .read-more-link:hover {
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
        .pagination {
            justify-content: center;
        }
        .page-link {
            background: rgba(15, 23, 42, 0.8);
            border-color: rgba(148, 163, 184, 0.3);
            color: #e2e8f0;
        }
        .page-link:hover {
            background: rgba(59, 130, 246, 0.2);
            border-color: rgba(59, 130, 246, 0.4);
            color: #f1f5f9;
        }
        .page-item.active .page-link {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border-color: #2563eb;
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
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-3">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="read-more-link">Home</a></li>
                <li class="breadcrumb-item active text-secondary" aria-current="page">All Notices</li>
            </ol>
        </nav>
        <h1 class="display-5 fw-bold mb-0">All Notices</h1>
        <p class="text-secondary mt-2 mb-0">Stay updated with all department announcements and important updates.</p>
    </div>

    <div class="row">
        <div class="col-lg-10 mx-auto">
            @forelse($notices as $notice)
                <div class="notice-card">
                    <div class="notice-meta">
                        <strong>Published:</strong> {{ $notice->created_at->format('F d, Y \a\t g:i A') }}
                        @if($notice->updated_at->gt($notice->created_at))
                            | <strong>Updated:</strong> {{ $notice->updated_at->format('F d, Y') }}
                        @endif
                    </div>
                    
                    <h3 class="notice-title">{{ $notice->title }}</h3>
                    
                    <div class="notice-preview">
                        {{ $notice->preview }}
                        @if($notice->needsReadMore())
                            ...
                        @endif
                    </div>
                    
                    @if($notice->needsReadMore())
                        <a href="{{ route('notices.show', $notice) }}" class="read-more-link">
                            Read Full Notice →
                        </a>
                    @endif
                </div>
            @empty
                <div class="notice-card text-center py-5">
                    <h4 class="notice-title">No Notices Available</h4>
                    <p class="notice-preview">There are currently no published notices. Please check back later for updates.</p>
                    <a href="{{ route('home') }}" class="read-more-link">Return to Homepage</a>
                </div>
            @endforelse

            @if($notices->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $notices->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>