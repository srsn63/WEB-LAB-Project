<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }} | KUET CSE Events</title>
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
        
        .event-banner-section {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            padding: 3rem 0;
            margin-bottom: 3rem;
        }
        
        .event-banner-img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid rgba(96, 165, 250, 0.3);
        }
        
        .event-details-card {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .event-title {
            color: #60a5fa;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 2rem;
        }
        
        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(148, 163, 184, 0.2);
        }
        
        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .meta-label {
            color: #94a3b8;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .meta-value {
            color: #e2e8f0;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .meta-value i {
            color: #60a5fa;
            margin-right: 0.5rem;
        }
        
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.9rem;
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
        
        .event-description {
            color: #cbd5e1;
            line-height: 1.8;
            font-size: 1.05rem;
            margin-bottom: 2rem;
        }
        
        .info-box {
            background: rgba(30, 64, 175, 0.1);
            border: 1px solid rgba(96, 165, 250, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .info-box h4 {
            color: #60a5fa;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        
        .info-box p {
            color: #cbd5e1;
            margin-bottom: 0;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            color: white;
        }
        
        .btn-back {
            background: rgba(100, 116, 139, 0.2);
            border: 1px solid rgba(148, 163, 184, 0.3);
            color: #e2e8f0;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-back:hover {
            background: rgba(100, 116, 139, 0.3);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-mortarboard-fill"></i> KUET CSE
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('events.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> All Events
                </a>
                <a href="{{ route('home') }}" class="btn-back">
                    <i class="bi bi-house-fill"></i> Home
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                @if($event->banner_image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $event->banner_image) }}" alt="{{ $event->title }}" class="event-banner-img">
                </div>
                @endif

                <div class="event-details-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="event-title">{{ $event->title }}</h1>
                        <div class="d-flex gap-2">
                            <span class="badge badge-{{ $event->status }}">
                                {{ ucfirst($event->status) }}
                            </span>
                            @if($event->is_featured)
                                <span class="badge badge-featured">
                                    <i class="bi bi-star-fill"></i> Featured
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($event->event_type)
                    <div class="mb-3">
                        <span class="badge bg-info"><i class="bi bi-tag-fill"></i> {{ $event->event_type }}</span>
                    </div>
                    @endif

                    <div class="event-meta">
                        <div class="meta-item">
                            <span class="meta-label"><i class="bi bi-calendar3"></i> Event Date</span>
                            <span class="meta-value">{{ $event->formatted_date }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label"><i class="bi bi-clock"></i> Time</span>
                            <span class="meta-value">{{ $event->formatted_time }}</span>
                        </div>
                        @if($event->venue)
                        <div class="meta-item">
                            <span class="meta-label"><i class="bi bi-geo-alt-fill"></i> Venue</span>
                            <span class="meta-value">{{ $event->venue }}</span>
                        </div>
                        @endif
                        @if($event->end_date && $event->duration)
                        <div class="meta-item">
                            <span class="meta-label"><i class="bi bi-hourglass-split"></i> Duration</span>
                            <span class="meta-value">{{ $event->duration }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="event-description">
                        <p>{{ $event->description }}</p>
                    </div>

                    @if($event->registration_link && $event->isUpcoming())
                    <div class="text-center py-3">
                        <a href="{{ $event->registration_link }}" target="_blank" class="btn-register">
                            <i class="bi bi-box-arrow-up-right"></i> Register Now
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                @if($event->organizer)
                <div class="info-box">
                    <h4><i class="bi bi-people-fill"></i> Organizer</h4>
                    <p>{{ $event->organizer }}</p>
                </div>
                @endif

                @if($event->contact_email)
                <div class="info-box">
                    <h4><i class="bi bi-envelope-fill"></i> Contact</h4>
                    <p><a href="mailto:{{ $event->contact_email }}" style="color: #60a5fa; text-decoration: none;">{{ $event->contact_email }}</a></p>
                </div>
                @endif

                @if($event->max_participants)
                <div class="info-box">
                    <h4><i class="bi bi-person-fill-check"></i> Max Participants</h4>
                    <p>{{ $event->max_participants }} participants</p>
                </div>
                @endif

                @if($event->end_date)
                <div class="info-box">
                    <h4><i class="bi bi-calendar-check-fill"></i> Event Schedule</h4>
                    <p><strong>Start:</strong> {{ $event->formatted_date_time }}</p>
                    <p class="mb-0"><strong>End:</strong> {{ $event->end_date->format('F j, Y \a\t g:i A') }}</p>
                </div>
                @endif

                @if($event->isOngoing())
                <div class="info-box" style="background: rgba(16, 185, 129, 0.1); border-color: rgba(52, 211, 153, 0.3);">
                    <h4 style="color: #34d399;"><i class="bi bi-broadcast"></i> Event is Live!</h4>
                    <p>This event is currently ongoing. Join now!</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
