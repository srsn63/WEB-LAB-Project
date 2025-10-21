<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events | KUET CSE</title>
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
        
        .section-title {
            color: #60a5fa;
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 1.8rem;
            text-align: center;
        }
        
        .event-card {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .event-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
            border-color: rgba(96, 165, 250, 0.5);
        }
        
        .event-banner {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        }
        
        .event-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .event-card h3 {
            color: #60a5fa;
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: 1.3rem;
        }
        
        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #94a3b8;
        }
        
        .meta-item i {
            color: #60a5fa;
        }
        
        .event-description {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }
        
        .badge {
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .badge-upcoming {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }
        
        .badge-ongoing {
            background: linear-gradient(135deg, #10b981, #34d399);
        }
        
        .badge-past {
            background: linear-gradient(135deg, #6b7280, #9ca3af);
        }
        
        .badge-featured {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
        }
        
        .btn-view-event {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-view-event:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            color: white;
        }
        
        .btn-home {
            background: rgba(100, 116, 139, 0.2);
            border: 1px solid rgba(148, 163, 184, 0.3);
            color: #e2e8f0;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-home:hover {
            background: rgba(100, 116, 139, 0.3);
            color: white;
        }
        
        .featured-events {
            background: rgba(30, 64, 175, 0.1);
            border: 1px solid rgba(96, 165, 250, 0.3);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 3rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #94a3b8;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #475569;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-mortarboard-fill"></i> KUET CSE
            </a>
            <a href="{{ route('home') }}" class="btn-home">
                <i class="bi bi-house-fill"></i> Back to Home
            </a>
        </div>
    </nav>

    <div class="page-header">
        <div class="container">
            <h1><i class="bi bi-calendar-event"></i> Events</h1>
            <p>Stay updated with upcoming events, workshops, seminars, and competitions</p>
        </div>
    </div>

    <div class="container pb-5">
        @if($featuredEvents->count() > 0)
        <!-- Featured Events -->
        <div class="featured-events">
            <h2 class="section-title"><i class="bi bi-star-fill"></i> Featured Events</h2>
            <div class="row">
                @foreach($featuredEvents as $event)
                <div class="col-md-4">
                    <div class="event-card">
                        @if($event->banner_image)
                            <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="event-banner">
                        @else
                            <div class="event-banner d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar-event display-1 text-muted"></i>
                            </div>
                        @endif
                        <div class="event-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h3 class="mb-0">{{ $event->title }}</h3>
                                <span class="badge badge-featured"><i class="bi bi-star-fill"></i></span>
                            </div>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="bi bi-calendar3"></i>
                                    <span>{{ $event->formatted_date }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-clock"></i>
                                    <span>{{ $event->formatted_time }}</span>
                                </div>
                                @if($event->venue)
                                <div class="meta-item">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <span>{{ $event->venue }}</span>
                                </div>
                                @endif
                            </div>
                            <p class="event-description">{{ Str::limit($event->description, 120) }}</p>
                            <a href="{{ route('events.show', $event) }}" class="btn btn-view-event w-100">
                                <i class="bi bi-arrow-right-circle"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Upcoming Events -->
        <h2 class="section-title"><i class="bi bi-calendar-check"></i> Upcoming Events</h2>
        <div class="row">
            @forelse($upcomingEvents as $event)
            <div class="col-md-4">
                <div class="event-card">
                    @if($event->banner_image)
                        <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="event-banner">
                    @else
                        <div class="event-banner d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-event display-1 text-muted"></i>
                        </div>
                    @endif
                    <div class="event-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h3 class="mb-0">{{ $event->title }}</h3>
                            <span class="badge badge-{{ $event->status }}">{{ ucfirst($event->status) }}</span>
                        </div>
                        @if($event->event_type)
                        <div class="mb-2">
                            <span class="badge bg-info">{{ $event->event_type }}</span>
                        </div>
                        @endif
                        <div class="event-meta">
                            <div class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $event->formatted_date }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ $event->formatted_time }}</span>
                            </div>
                            @if($event->venue)
                            <div class="meta-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $event->venue }}</span>
                            </div>
                            @endif
                        </div>
                        <p class="event-description">{{ Str::limit($event->description, 120) }}</p>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-view-event w-100">
                            <i class="bi bi-arrow-right-circle"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <h3>No Upcoming Events</h3>
                    <p>Check back later for new events and activities!</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($upcomingEvents->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $upcomingEvents->links() }}
        </div>
        @endif

        <!-- Past Events -->
        @if($pastEvents->count() > 0)
        <h2 class="section-title mt-5"><i class="bi bi-clock-history"></i> Past Events</h2>
        <div class="row">
            @foreach($pastEvents as $event)
            <div class="col-md-4">
                <div class="event-card">
                    @if($event->banner_image)
                        <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="event-banner">
                    @else
                        <div class="event-banner d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-event display-1 text-muted"></i>
                        </div>
                    @endif
                    <div class="event-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h3 class="mb-0">{{ $event->title }}</h3>
                            <span class="badge badge-past">Past</span>
                        </div>
                        @if($event->event_type)
                        <div class="mb-2">
                            <span class="badge bg-secondary">{{ $event->event_type }}</span>
                        </div>
                        @endif
                        <div class="event-meta">
                            <div class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $event->formatted_date }}</span>
                            </div>
                            @if($event->venue)
                            <div class="meta-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $event->venue }}</span>
                            </div>
                            @endif
                        </div>
                        <p class="event-description">{{ Str::limit($event->description, 120) }}</p>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-view-event w-100">
                            <i class="bi bi-arrow-right-circle"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($pastEvents->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $pastEvents->links() }}
        </div>
        @endif
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
