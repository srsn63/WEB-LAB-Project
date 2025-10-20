<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Opportunities | KUET CSE</title>
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
        
        .filter-section {
            background: rgba(30, 41, 59, 0.6);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(148, 163, 184, 0.2);
        }
        
        .filter-btn {
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            border: 2px solid rgba(148, 163, 184, 0.3);
            background: rgba(30, 41, 59, 0.6);
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0.25rem;
        }
        
        .filter-btn:hover {
            background: rgba(59, 130, 246, 0.2);
            border-color: #60a5fa;
            color: #60a5fa;
        }
        
        .filter-btn.active {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border-color: #60a5fa;
            color: white;
        }
        
        .opportunity-card {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .opportunity-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
            border-color: rgba(96, 165, 250, 0.5);
        }
        
        .opportunity-card h4 {
            color: #60a5fa;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
        }
        
        .company-name {
            color: #e2e8f0;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        
        .opportunity-description {
            color: #cbd5e1;
            margin-bottom: 1rem;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .opportunity-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #94a3b8;
        }
        
        .meta-item i {
            color: #60a5fa;
        }
        
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 999px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .badge-internship {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
        }
        
        .badge-fulltime {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: white;
        }
        
        .badge-parttime {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            color: white;
        }
        
        .badge-deadline {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .btn-view {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            color: white;
        }
        
        .btn-back {
            background: rgba(100, 116, 139, 0.2);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.3);
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: rgba(100, 116, 139, 0.3);
            color: #e2e8f0;
        }

        /* smaller button variant for compact CTAs */
        .btn-small {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.9rem;
            font-size: 0.95rem;
            border-radius: 10px;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: #ffffff;
            border: none;
            text-decoration: none;
            transition: all 0.18s ease;
        }

        .btn-small i { font-size: 1.05rem; }

        .btn-small:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(59,130,246,0.18); }
        
        .no-results {
            text-align: center;
            padding: 4rem 2rem;
            color: #94a3b8;
        }
        
        .no-results i {
            font-size: 4rem;
            color: #475569;
            margin-bottom: 1rem;
        }
        
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }
        
        .pagination .page-link {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: #cbd5e1;
        }
        
        .pagination .page-link:hover {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border-color: #60a5fa;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-mortarboard-fill"></i> KUET CSE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-briefcase-fill"></i> Career Opportunities</h1>
            <p>Discover internships and job opportunities for KUET CSE students</p>
        </div>
    </div>

    <div class="container pb-5">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-3 mb-md-0"><i class="bi bi-funnel-fill"></i> Filter by Job Type</h5>
                <div>
                    <a href="{{ route('career-opportunities.index') }}" class="filter-btn {{ !request('job_type') ? 'active' : '' }}">
                        All Opportunities
                    </a>
                    @foreach($jobTypes as $key => $label)
                        <a href="{{ route('career-opportunities.index', ['job_type' => $key]) }}" class="filter-btn {{ request('job_type') == $key ? 'active' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        @if($opportunities->count() > 0)
            <div class="row">
                @foreach($opportunities as $opportunity)
                    <div class="col-lg-6 mb-4">
                        <div class="opportunity-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h4>{{ $opportunity->title }}</h4>
                                @if($opportunity->job_type == 'internship')
                                    <span class="badge badge-internship">Internship</span>
                                @elseif($opportunity->job_type == 'full-time')
                                    <span class="badge badge-fulltime">Full-Time</span>
                                @elseif($opportunity->job_type == 'part-time')
                                    <span class="badge badge-parttime">Part-Time</span>
                                @endif
                            </div>
                            
                            <div class="company-name">
                                <i class="bi bi-building"></i> {{ $opportunity->company_name }}
                            </div>
                            
                            <p class="opportunity-description">{{ $opportunity->description }}</p>
                            
                            <div class="opportunity-meta">
                                @if($opportunity->location)
                                    <div class="meta-item">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ $opportunity->location }}</span>
                                    </div>
                                @endif
                                
                                @if($opportunity->salary_range)
                                    <div class="meta-item">
                                        <i class="bi bi-cash-stack"></i>
                                        <span>{{ $opportunity->salary_range }}</span>
                                    </div>
                                @endif
                                
                                @if($opportunity->deadline)
                                    <div class="meta-item">
                                        <i class="bi bi-calendar-event"></i>
                                        <span>
                                            Deadline: {{ \Carbon\Carbon::parse($opportunity->deadline)->format('M d, Y') }}
                                            @if(\Carbon\Carbon::parse($opportunity->deadline)->isPast())
                                                <span class="badge badge-deadline ms-1">Expired</span>
                                            @endif
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('career-opportunities.show', $opportunity) }}" class="btn-view">
                                    View Details <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $opportunities->links() }}
            </div>
        @else
            <div class="no-results">
                <i class="bi bi-briefcase"></i>
                <h3>No Opportunities Found</h3>
                <p>There are currently no {{ request('job_type') ? $jobTypes[request('job_type')] : '' }} opportunities available.</p>
                @if(request('job_type'))
                    <a href="{{ route('career-opportunities.index') }}" class="btn-small mt-3">
                        <i class="bi bi-arrow-left"></i>
                        <span>View All Opportunities</span>
                    </a>
                @endif
            </div>
        @endif

        <div class="text-center mt-5">
            <a href="{{ url('/') }}" class="btn-back">
                <i class="bi bi-house-fill"></i> Back to Home
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
