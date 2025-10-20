<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Programs | KUET CSE</title>
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
        
        .program-card {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }
        
        .program-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
            border-color: rgba(96, 165, 250, 0.5);
        }
        
        .program-card h3 {
            color: #60a5fa;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .program-card h4 {
            color: #e2e8f0;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        
        .program-info {
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
        }
        
        .info-item i {
            color: #60a5fa;
            font-size: 1.1rem;
        }
        
        .program-description {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 999px;
            font-weight: 500;
            font-size: 0.85rem;
            margin-right: 0.5rem;
        }
        
        .badge-undergraduate {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            color: white;
        }
        
        .badge-postgraduate {
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            color: white;
        }
        
        .btn-view {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
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

        .coordinator-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(59, 130, 246, 0.2);
            padding: 0.3rem 0.8rem;
            border-radius: 999px;
            font-size: 0.85rem;
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.3);
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
            <h1><i class="bi bi-book-fill"></i> Academic Programs</h1>
            <p>Explore our comprehensive programs designed to prepare students for successful careers in technology</p>
        </div>
    </div>

    <div class="container pb-5">
        <!-- Filter Section -->
        @if($programs->count() > 1)
        <div class="filter-section">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-3 mb-md-0"><i class="bi bi-funnel-fill"></i> Filter by Degree Type</h5>
                <div>
                    <a href="{{ route('programs.index') }}" class="filter-btn {{ !request('degree_type') ? 'active' : '' }}">
                        All Programs
                    </a>
                    @foreach($degreeTypes as $key => $label)
                        <a href="{{ route('programs.index', ['degree_type' => $key]) }}" class="filter-btn {{ request('degree_type') == $key ? 'active' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if($programs->count() > 0)
            @foreach($programs as $program)
                <div class="program-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h3>{{ $program->short_name }}</h3>
                            <h4>{{ $program->name }}</h4>
                        </div>
                        <div>
                            @if($program->degree_type == 'undergraduate')
                                <span class="badge badge-undergraduate">Undergraduate</span>
                            @else
                                <span class="badge badge-postgraduate">Postgraduate</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="program-info">
                        <div class="info-item">
                            <i class="bi bi-clock-fill"></i>
                            <span><strong>Duration:</strong> {{ $program->duration }}</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-award-fill"></i>
                            <span><strong>Total Credits:</strong> {{ $program->total_credits }}</span>
                        </div>
                        @if($program->coordinator)
                            <div class="info-item">
                                <i class="bi bi-person-fill"></i>
                                <span class="coordinator-badge">
                                    <i class="bi bi-person-badge"></i>
                                    Coordinator: {{ $program->coordinator->name }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <p class="program-description">
                        {{ Str::limit($program->description, 300) }}
                    </p>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('programs.show', $program) }}" class="btn-view">
                            <i class="bi bi-arrow-right-circle"></i> View Full Program Details
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-results">
                <i class="bi bi-mortarboard"></i>
                <h3>No Programs Found</h3>
                <p>There are currently no {{ request('degree_type') ? $degreeTypes[request('degree_type')] : '' }} programs available.</p>
                @if(request('degree_type'))
                    <a href="{{ route('programs.index') }}" class="btn-view mt-3">
                        <i class="bi bi-arrow-left"></i> View All Programs
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
