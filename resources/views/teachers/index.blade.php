<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Directory | KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #020617 0%, #0f172a 45%, #1e293b 100%);
            color: #e2e8f0;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }
        .navbar {
            background: rgba(15, 23, 42, 0.9) !important;
            border-bottom: 1px solid rgba(148, 163, 184, 0.2);
        }
        .hero {
            padding: 4rem 0 3rem;
            text-align: center;
        }
        .faculty-card {
            background: rgba(15, 23, 42, 0.82);
            border: 1px solid rgba(59, 130, 246, 0.25);
            border-radius: 20px;
            box-shadow: 0 18px 70px rgba(59, 130, 246, 0.35);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .faculty-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 80px rgba(14, 165, 233, 0.35);
        }
        .faculty-card img {
            height: 240px;
            object-fit: cover;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            border-radius: 999px;
        }
        .tag {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            background: rgba(59, 130, 246, 0.14);
            border: 1px solid rgba(59, 130, 246, 0.35);
            color: #bfdbfe;
            font-size: 0.75rem;
            margin: 0.15rem;
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

<section class="hero">
    <div class="container">
        <h1 class="display-5 fw-bold">Our Faculty Members</h1>
        <p class="lead text-secondary">Discover the scholars and innovators leading research and teaching at KUET CSE.</p>
    </div>
</section>

<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            @forelse($teachers as $teacher)
                <div class="col-md-6 col-xl-4">
                    <div class="faculty-card h-100">
                        <img src="{{ $teacher->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($teacher->name) . '&background=1a2238&color=ffffff' }}" class="w-100" alt="{{ $teacher->name }}">
                        <div class="p-4 d-flex flex-column h-100">
                            <div class="mb-3">
                                <h3 class="h5 mb-1">{{ $teacher->name }}</h3>
                                <p class="text-info mb-1">{{ $teacher->designation }}</p>
                                <small class="text-secondary">{{ $teacher->department }}</small>
                            </div>
                            @if($teacher->research_interests)
                                <div class="mb-3">
                                    @foreach(collect(explode(',', $teacher->research_interests))->map(fn($item) => trim($item))->filter() as $interest)
                                        <span class="tag">{{ $interest }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mt-auto">
                                <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-gradient w-100">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="faculty-card p-5 text-center">
                        <h3 class="h4 mb-3">Faculty profiles coming soon</h3>
                        <p class="mb-0 text-secondary">Check back shortly as we publish detailed information about our teachers.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
</body>
</html>
