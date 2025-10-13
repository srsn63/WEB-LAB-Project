<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $teacher->name }} | KUET CSE</title>
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
        .hero-card, .section-card, .contact-card {
            background: #000000 !important;
            border: 2px solid #333333;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
        }
        .section-card {
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .contact-card {
            padding: 1.8rem;
        }
        .profile-image {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            aspect-ratio: 4/5;
            border: 2px solid #333333;
        }
        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.9rem;
            border-radius: 999px;
            background: #333333;
            border: 1px solid #555555;
            color: #ffffff !important;
            font-size: 0.8rem;
            margin: 0.25rem 0.2rem;
        }
        .section-card h2 {
            font-size: 1.4rem;
            margin-bottom: 1.25rem;
            color: #ffffff !important;
        }
        .timeline {
            border-left: 2px solid #ffffff;
            padding-left: 1.5rem;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 1.2rem;
            color: #ffffff !important;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.7rem;
            top: 0.3rem;
            width: 12px;
            height: 12px;
            background: #ffffff;
            border-radius: 50%;
            box-shadow: 0 0 0 6px rgba(255, 255, 255, 0.15);
        }
        .contact-card a {
            color: #ffffff !important;
        }
        .btn-gradient, .btn-primary {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            padding: 0.6rem 1.4rem;
            border-radius: 999px;
            font-weight: 600;
            color: #ffffff;
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
        .text-muted, .text-secondary {
            color: #cccccc !important;
        }
        .text-info {
            color: #ffffff !important;
        }
        .form-control {
            background: #000000 !important;
            border: 2px solid #555555 !important;
            color: #ffffff !important;
        }
        .form-control:focus {
            background: #000000 !important;
            border-color: #ffffff !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }
        .input-group .btn {
            border-color: #555555;
        }
        h1, h2, h3, h4, h5, h6, p, strong {
            color: #ffffff !important;
        }
        .lead {
            color: #ffffff !important;
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
                    <div class="input-group">
                        <input type="text" class="form-control" id="profileUrl" value="{{ request()->fullUrl() }}" readonly>
                        <button class="btn btn-gradient" onclick="copyProfileUrl()" title="Copy profile link">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function copyProfileUrl() {
    const urlInput = document.getElementById('profileUrl');
    urlInput.select();
    urlInput.setSelectionRange(0, 99999); // For mobile devices
    
    navigator.clipboard.writeText(urlInput.value).then(function() {
        // Change button appearance briefly to show success
        const button = document.querySelector('button[onclick="copyProfileUrl()"]');
        const originalHTML = button.innerHTML;
        button.innerHTML = '<svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>';
        setTimeout(() => {
            button.innerHTML = originalHTML;
        }, 1000);
    }).catch(function() {
        // Fallback for older browsers
        document.execCommand('copy');
    });
}
</script>
</body>
</html>
