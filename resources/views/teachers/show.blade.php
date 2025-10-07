<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $teacher->name }} | KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.25), transparent 45%),
                        linear-gradient(180deg, #020617 0%, #0f172a 50%, #111827 100%);
            color: #e2e8f0;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }
        .navbar {
            background: rgba(15, 23, 42, 0.92) !important;
            border-bottom: 1px solid rgba(148, 163, 184, 0.25);
        }
        .hero-card {
            background: rgba(15, 23, 42, 0.82);
            border-radius: 28px;
            border: 1px solid rgba(59, 130, 246, 0.35);
            box-shadow: 0 30px 120px rgba(14, 165, 233, 0.35);
            overflow: hidden;
        }
        .profile-image {
            width: 100%;
            border-radius: 24px;
            object-fit: cover;
            aspect-ratio: 4/5;
            border: 1px solid rgba(148, 163, 184, 0.25);
        }
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.9rem;
            border-radius: 999px;
            background: rgba(59, 130, 246, 0.14);
            border: 1px solid rgba(59, 130, 246, 0.35);
            color: #bfdbfe;
            font-size: 0.8rem;
            margin: 0.25rem 0.2rem;
        }
        .section-card {
            background: rgba(15, 23, 42, 0.78);
            border-radius: 24px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            box-shadow: 0 20px 90px rgba(30, 64, 175, 0.35);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .section-card h2 {
            font-size: 1.4rem;
            margin-bottom: 1.25rem;
        }
        .timeline {
            border-left: 2px solid rgba(56, 189, 248, 0.6);
            padding-left: 1.5rem;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 1.2rem;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.7rem;
            top: 0.3rem;
            width: 12px;
            height: 12px;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border-radius: 50%;
            box-shadow: 0 0 0 6px rgba(37, 99, 235, 0.15);
        }
        .contact-card {
            background: rgba(2, 6, 23, 0.88);
            border-radius: 24px;
            border: 1px solid rgba(59, 130, 246, 0.25);
            padding: 1.8rem;
        }
        .contact-card a {
            color: #60a5fa;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            padding: 0.6rem 1.4rem;
            border-radius: 999px;
            font-weight: 600;
        }
        .text-muted {
            color: rgba(148, 163, 184, 0.85) !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="{{ route('home') }}">KUET CSE</a>
        <div class="ms-auto">
            <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">Back to Homepage</a>
        </div>
    </div>
</nav>

<section class="py-5">
    <div class="container">
        <div class="hero-card p-4 p-lg-5 mb-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-4">
                    <img src="{{ $teacher->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($teacher->name) . '&background=1a2238&color=ffffff' }}" alt="{{ $teacher->name }}" class="profile-image">
                </div>
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-2">{{ $teacher->name }}</h1>
                    <p class="h5 text-info mb-3">{{ $teacher->designation }}</p>
                    <p class="text-muted mb-4">{{ $teacher->department }}</p>
                    @if($teacher->short_bio)
                        <p class="lead mb-4">{{ $teacher->short_bio }}</p>
                    @endif
                    @if($teacher->research_interests)
                        <div class="d-flex flex-wrap">
                            @foreach(collect(explode(',', $teacher->research_interests))->map(fn($item) => trim($item))->filter() as $interest)
                                <span class="chip">{{ $interest }}</span>
                            @endforeach
                        </div>
                    @endif
                    <div class="contact-card mt-4">
                        <div class="row g-3">
                            @if($teacher->email)
                                <div class="col-md-6">
                                    <strong>Email</strong>
                                    <p class="mb-0"><a href="mailto:{{ $teacher->email }}">{{ $teacher->email }}</a></p>
                                </div>
                            @endif
                            @if($teacher->phone)
                                <div class="col-md-6">
                                    <strong>Phone</strong>
                                    <p class="mb-0"><a href="tel:{{ $teacher->phone }}">{{ $teacher->phone }}</a></p>
                                </div>
                            @endif
                            @if($teacher->office_room)
                                <div class="col-md-6">
                                    <strong>Office</strong>
                                    <p class="mb-0">{{ $teacher->office_room }}</p>
                                </div>
                            @endif
                            @if($teacher->website_url)
                                <div class="col-md-6">
                                    <strong>Website</strong>
                                    <p class="mb-0"><a href="{{ $teacher->website_url }}" target="_blank" rel="noopener">Visit profile</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                @if(!empty($teacher->education))
                    <div class="section-card">
                        <h2>Education</h2>
                        <div class="timeline">
                            @foreach($teacher->education as $entry)
                                <div class="timeline-item">
                                    <p class="mb-0">{{ $entry }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(!empty($teacher->courses))
                    <div class="section-card">
                        <h2>Courses Taught</h2>
                        <div class="row g-3">
                            @foreach($teacher->courses as $course)
                                <div class="col-md-6">
                                    <div class="chip w-100 justify-content-center">{{ $course }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($teacher->publications)
                    <div class="section-card">
                        <h2>Publications Highlight</h2>
                        <p class="mb-0">{{ $teacher->publications }}</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                @if(!empty($teacher->honors))
                    <div class="section-card">
                        <h2>Honors & Awards</h2>
                        <ul class="list-unstyled mb-0">
                            @foreach($teacher->honors as $honor)
                                <li class="mb-3">
                                    <span class="chip">{{ $honor }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="section-card">
                    <h2>Share Profile</h2>
                    <p class="text-muted">Copy the link below to share this teacher's dashboard.</p>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ request()->fullUrl() }}" readonly>
                        <a href="{{ request()->fullUrl() }}" class="btn btn-gradient">Open</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
