<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clubs | KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: #60a5fa !important;
        }
        
        .page-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            padding: 4rem 0;
            margin-bottom: 3rem;
            text-align: center;
            color: white;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .club-card {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .club-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
            border-color: rgba(96, 165, 250, 0.5);
        }
        
        .club-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            margin-bottom: 1rem;
            border: 2px solid rgba(96, 165, 250, 0.3);
        }
        
        .club-card h3 {
            color: #60a5fa;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }
        
        .club-card h4 {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 1rem;
            font-weight: 400;
        }
        
        .club-description {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        
        .club-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #94a3b8;
            font-size: 0.9rem;
        }
        
        .info-item i {
            color: #60a5fa;
            font-size: 1.1rem;
        }
        
        .club-links {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .social-link {
            color: #60a5fa;
            font-size: 1.3rem;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            color: #38bdf8;
            transform: scale(1.1);
        }
        
        .btn-view-details {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-view-details:hover {
            background: linear-gradient(135deg, #1d4ed8, #0ea5e9);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        
        .back-btn {
            background: rgba(30, 41, 59, 0.8);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.3);
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .back-btn:hover {
            background: rgba(59, 130, 246, 0.2);
            border-color: #60a5fa;
            color: #60a5fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-building"></i> KUET CSE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-people-fill"></i> Student Clubs</h1>
            <p>Explore our vibrant student clubs and communities</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="mb-4">
            <a href="/" class="back-btn">
                <i class="bi bi-arrow-left"></i> Back to Home
            </a>
        </div>

        <div class="row">
            @forelse($clubs as $club)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="club-card">
                        @if($club->logo)
                            <img src="{{ asset('storage/' . $club->logo) }}" alt="{{ $club->name }}" class="club-logo">
                        @else
                            <div class="club-logo d-flex align-items-center justify-content-center" style="background: rgba(96, 165, 250, 0.2);">
                                <i class="bi bi-people-fill" style="font-size: 2rem; color: #60a5fa;"></i>
                            </div>
                        @endif
                        
                        <h3>{{ $club->name }}</h3>
                        <h4>{{ $club->short_name }}</h4>
                        
                        <p class="club-description">
                            {{ Str::limit($club->description, 120) }}
                        </p>
                        
                        <div class="club-info">
                            <div class="info-item">
                                <i class="bi bi-people"></i>
                                <span>{{ $club->members_count }} {{ Str::plural('Member', $club->members_count) }}</span>
                            </div>
                            @if($club->founded_date)
                                <div class="info-item">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>Founded {{ \Carbon\Carbon::parse($club->founded_date)->format('Y') }}</span>
                                </div>
                            @endif
                        </div>
                        
                        @if($club->facebook_url || $club->website_url || $club->email)
                            <div class="club-links">
                                @if($club->facebook_url)
                                    <a href="{{ $club->facebook_url }}" target="_blank" class="social-link" title="Facebook">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                @endif
                                @if($club->website_url)
                                    <a href="{{ $club->website_url }}" target="_blank" class="social-link" title="Website">
                                        <i class="bi bi-globe"></i>
                                    </a>
                                @endif
                                @if($club->email)
                                    <a href="mailto:{{ $club->email }}" class="social-link" title="Email">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                        
                        <a href="{{ route('clubs.show', $club) }}" class="btn-view-details">
                            View Details <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="club-card text-center py-5">
                        <i class="bi bi-people" style="font-size: 4rem; color: #60a5fa; opacity: 0.5;"></i>
                        <h3 class="mt-3">No Clubs Available</h3>
                        <p class="text-muted">Check back later for updates</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
