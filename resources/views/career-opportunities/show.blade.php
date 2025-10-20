<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $opportunity->title }} | KUET CSE Career Opportunities</title>
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
        
        .detail-container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 0 1rem;
        }
        
        .detail-card {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .detail-header {
            border-bottom: 2px solid rgba(148, 163, 184, 0.2);
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .job-title {
            color: #60a5fa;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        
        .company-name {
            color: #e2e8f0;
            font-size: 1.4rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .company-name i {
            color: #60a5fa;
        }
        
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-weight: 500;
            font-size: 0.9rem;
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
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
            padding: 1.5rem;
            background: rgba(15, 23, 42, 0.4);
            border-radius: 12px;
        }
        
        .info-item {
            display: flex;
            align-items: start;
            gap: 0.75rem;
        }
        
        .info-item i {
            color: #60a5fa;
            font-size: 1.25rem;
            margin-top: 0.25rem;
        }
        
        .info-label {
            color: #94a3b8;
            font-size: 0.85rem;
            margin-bottom: 0.25rem;
        }
        
        .info-value {
            color: #e2e8f0;
            font-weight: 500;
        }
        
        .section-title {
            color: #60a5fa;
            font-size: 1.4rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .description-text {
            color: #cbd5e1;
            line-height: 1.8;
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
        }
        
        .requirements-list {
            color: #cbd5e1;
            line-height: 1.8;
            white-space: pre-line;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }
        
        .btn-apply {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s ease;
        }
        
        .btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            color: white;
        }
        
        .btn-back {
            background: rgba(100, 116, 139, 0.2);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.3);
            padding: 0.85rem 2rem;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: rgba(100, 116, 139, 0.3);
            color: #e2e8f0;
        }
        
        .deadline-alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 10px;
            padding: 1rem;
            margin: 1.5rem 0;
            color: #fca5a5;
        }
        
        .contact-info {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        
        .contact-info a {
            color: #60a5fa;
            text-decoration: none;
        }
        
        .contact-info a:hover {
            text-decoration: underline;
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('career-opportunities.index') }}">Career Opportunities</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="detail-container">
        <div class="detail-card">
            <div class="detail-header">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h1 class="job-title">{{ $opportunity->title }}</h1>
                    @if($opportunity->job_type == 'internship')
                        <span class="badge badge-internship">Internship</span>
                    @elseif($opportunity->job_type == 'full-time')
                        <span class="badge badge-fulltime">Full-Time</span>
                    @elseif($opportunity->job_type == 'part-time')
                        <span class="badge badge-parttime">Part-Time</span>
                    @endif
                </div>
                <div class="company-name">
                    <i class="bi bi-building-fill"></i>
                    {{ $opportunity->company_name }}
                </div>
            </div>

            <!-- Quick Info Grid -->
            <div class="info-grid">
                @if($opportunity->location)
                    <div class="info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div>
                            <div class="info-label">Location</div>
                            <div class="info-value">{{ $opportunity->location }}</div>
                        </div>
                    </div>
                @endif

                @if($opportunity->salary_range)
                    <div class="info-item">
                        <i class="bi bi-cash-stack"></i>
                        <div>
                            <div class="info-label">Salary Range</div>
                            <div class="info-value">{{ $opportunity->salary_range }}</div>
                        </div>
                    </div>
                @endif

                @if($opportunity->deadline)
                    <div class="info-item">
                        <i class="bi bi-calendar-event"></i>
                        <div>
                            <div class="info-label">Application Deadline</div>
                            <div class="info-value">
                                {{ \Carbon\Carbon::parse($opportunity->deadline)->format('F d, Y') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if($opportunity->deadline && \Carbon\Carbon::parse($opportunity->deadline)->isPast())
                <div class="deadline-alert">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong>Note:</strong> The application deadline for this opportunity has passed.
                </div>
            @endif

            <!-- Description Section -->
            <h2 class="section-title">
                <i class="bi bi-file-text-fill"></i>
                Job Description
            </h2>
            <p class="description-text">{{ $opportunity->description }}</p>

            <!-- Requirements Section -->
            @if($opportunity->requirements)
                <h2 class="section-title">
                    <i class="bi bi-check-circle-fill"></i>
                    Requirements
                </h2>
                <div class="requirements-list">{{ $opportunity->requirements }}</div>
            @endif

            <!-- Contact Information -->
            @if($opportunity->contact_email)
                <div class="contact-info">
                    <h3 class="h6 mb-2"><i class="bi bi-envelope-fill"></i> Contact Information</h3>
                    <p class="mb-0">
                        For inquiries, please contact: 
                        <a href="mailto:{{ $opportunity->contact_email }}">{{ $opportunity->contact_email }}</a>
                    </p>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="action-buttons">
                @if($opportunity->application_link)
                    <a href="{{ $opportunity->application_link }}" target="_blank" class="btn-apply">
                        <i class="bi bi-box-arrow-up-right"></i>
                        Apply Now
                    </a>
                @endif
                <a href="{{ route('career-opportunities.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Back to Opportunities
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
