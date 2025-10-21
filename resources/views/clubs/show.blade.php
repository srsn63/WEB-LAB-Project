<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $club->name }} - KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero-header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            padding: 3rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .hero-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .hero-header .lead {
            font-size: 1.2rem;
            opacity: 0.95;
        }

        .club-logo-large {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 1rem;
        }

        .info-cards {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .info-card i {
            font-size: 1.5rem;
            color: #60a5fa;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            color: white;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .social-link:hover {
            background: rgba(96, 165, 250, 0.3);
            color: #60a5fa;
            transform: translateY(-2px);
        }

        .content-container {
            background: #000000;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            margin-bottom: 2rem;
        }

        .nav-tabs {
            border-bottom: 2px solid #1e40af;
            margin-bottom: 2rem;
        }

        .nav-tabs .nav-link {
            color: #94a3b8;
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 8px 8px 0 0;
        }

        .nav-tabs .nav-link:hover {
            color: #60a5fa;
            background: rgba(96, 165, 250, 0.1);
        }

        .nav-tabs .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border: none;
        }

        .section-title {
            color: #60a5fa;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .member-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .member-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(96, 165, 250, 0.2);
        }

        .member-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .member-name {
            color: #ffffff;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .member-role {
            color: #60a5fa;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .member-info {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .role-badge {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .role-badge.executive {
            background: linear-gradient(135deg, #dc2626, #f59e0b);
        }

        .members-list {
            list-style: none;
            padding: 0;
        }

        .members-list li {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .members-list li:last-child {
            border-bottom: none;
        }

        .member-list-name {
            color: #ffffff;
            font-weight: 500;
        }

        .member-list-role {
            color: #94a3b8;
            font-size: 0.9rem;
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
    <div class="hero-header">
        <div class="container">
            @if($club->logo)
                <img src="{{ asset('storage/' . $club->logo) }}" alt="{{ $club->name }}" class="club-logo-large">
            @else
                <div class="club-logo-large d-flex align-items-center justify-content-center" style="background: rgba(96, 165, 250, 0.2);">
                    <i class="bi bi-people-fill" style="font-size: 3rem; color: #60a5fa;"></i>
                </div>
            @endif
            
            <h1>{{ $club->name }}</h1>
            <p class="lead">{{ $club->short_name }}</p>
            
            <div class="info-cards">
                <div class="info-card">
                    <i class="bi bi-people"></i>
                    <div>
                        <div style="font-size: 0.85rem; opacity: 0.8;">Total Members</div>
                        <div style="font-size: 1.2rem; font-weight: 700;">{{ $club->getTotalMembersCount() }}</div>
                    </div>
                </div>
                
                @if($club->founded_date)
                    <div class="info-card">
                        <i class="bi bi-calendar-event"></i>
                        <div>
                            <div style="font-size: 0.85rem; opacity: 0.8;">Founded</div>
                            <div style="font-size: 1.2rem; font-weight: 700;">{{ \Carbon\Carbon::parse($club->founded_date)->format('Y') }}</div>
                        </div>
                    </div>
                @endif
                
                <div class="info-card">
                    <i class="bi bi-person-check"></i>
                    <div>
                        <div style="font-size: 0.85rem; opacity: 0.8;">Active Members</div>
                        <div style="font-size: 1.2rem; font-weight: 700;">{{ $club->getActiveMembersCount() }}</div>
                    </div>
                </div>
            </div>

            @if($club->facebook_url || $club->website_url || $club->email)
                <div class="social-links">
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
        </div>
    </div>

    <div class="container mb-5">
        <div class="mb-4">
            <a href="{{ route('clubs.index') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Back to Clubs
            </a>
        </div>

        <ul class="nav nav-tabs" id="clubTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button">
                    <i class="bi bi-info-circle"></i> About
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="executives-tab" data-bs-toggle="tab" data-bs-target="#executives" type="button">
                    <i class="bi bi-person-badge"></i> Executive Committee
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="workshops-tab" data-bs-toggle="tab" data-bs-target="#workshops" type="button">
                    <i class="bi bi-book"></i> Workshops
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button">
                    <i class="bi bi-calendar-event"></i> Events
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="members-tab" data-bs-toggle="tab" data-bs-target="#members" type="button">
                    <i class="bi bi-people"></i> All Members
                </button>
            </li>
        </ul>

        <div class="tab-content" id="clubTabsContent">
            <!-- About Tab -->
            <div class="tab-pane fade show active" id="about" role="tabpanel">
                <div class="content-container">
                    <div class="section-title">
                        <i class="bi bi-file-text"></i> Description
                    </div>
                    <p style="color: #cbd5e1; line-height: 1.8;">{{ $club->description }}</p>

                    @if($club->mission)
                        <div class="section-title mt-4">
                            <i class="bi bi-bullseye"></i> Mission
                        </div>
                        <p style="color: #cbd5e1; line-height: 1.8;">{{ $club->mission }}</p>
                    @endif

                    @if($club->vision)
                        <div class="section-title mt-4">
                            <i class="bi bi-eye"></i> Vision
                        </div>
                        <p style="color: #cbd5e1; line-height: 1.8;">{{ $club->vision }}</p>
                    @endif
                </div>
            </div>

            <!-- Executive Committee Tab -->
            <div class="tab-pane fade" id="executives" role="tabpanel">
                <div class="content-container">
                    <div class="section-title">
                        <i class="bi bi-person-badge"></i> Executive Committee
                    </div>
                    
                    @if($executives->count() > 0)
                        <div class="row">
                            @foreach($executives as $member)
                                <div class="col-md-6 col-lg-4">
                                    <div class="member-card">
                                        <div class="member-avatar">
                                            {{ strtoupper(substr($member->student->name ?? 'S', 0, 1)) }}
                                        </div>
                                        <div class="member-name">{{ $member->student->name ?? 'N/A' }}</div>
                                        <div class="member-role">{{ $member->role }}</div>
                                        @if($member->student->student_id)
                                            <div class="member-info">ID: {{ $member->student->student_id }}</div>
                                        @endif
                                        @if($member->responsibilities)
                                            <div class="member-info mt-2" style="font-size: 0.85rem;">
                                                <strong>Responsibilities:</strong><br>
                                                {{ $member->responsibilities }}
                                            </div>
                                        @endif
                                        <span class="role-badge executive">{{ $member->role }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #94a3b8; text-align: center; padding: 2rem;">No executive members assigned yet.</p>
                    @endif
                </div>
            </div>

            <!-- Workshops Tab -->
            <div class="tab-pane fade" id="workshops" role="tabpanel">
                <div class="content-container">
                    <div class="section-title">
                        <i class="bi bi-book"></i> Workshops ({{ $workshops->count() }})
                    </div>
                    
                    @if($workshops->count() > 0)
                        <div class="row">
                            @foreach($workshops as $workshop)
                                <div class="col-md-12 mb-4">
                                    <div class="member-card">
                                        <h4 style="color: #60a5fa; font-size: 1.3rem; margin-bottom: 0.5rem;">
                                            {{ $workshop->title }}
                                        </h4>
                                        <p style="color: #94a3b8; margin-bottom: 1rem;">
                                            <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($workshop->start_date)->format('F d, Y - h:i A') }}
                                            @if($workshop->end_date)
                                                to {{ \Carbon\Carbon::parse($workshop->end_date)->format('h:i A') }}
                                            @endif
                                        </p>
                                        @if($workshop->instructor)
                                            <p style="color: #cbd5e1; margin-bottom: 0.5rem;">
                                                <i class="bi bi-person"></i> <strong>Instructor:</strong> {{ $workshop->instructor }}
                                            </p>
                                        @endif
                                        @if($workshop->venue)
                                            <p style="color: #cbd5e1; margin-bottom: 0.5rem;">
                                                <i class="bi bi-geo-alt"></i> <strong>Venue:</strong> {{ $workshop->venue }}
                                            </p>
                                        @endif
                                        @if($workshop->max_participants)
                                            <p style="color: #cbd5e1; margin-bottom: 0.5rem;">
                                                <i class="bi bi-people"></i> <strong>Max Participants:</strong> {{ $workshop->max_participants }}
                                            </p>
                                        @endif
                                        <p style="color: #cbd5e1; line-height: 1.6; margin-top: 1rem;">
                                            {{ $workshop->description }}
                                        </p>
                                        @if($workshop->registration_link)
                                            <a href="{{ $workshop->registration_link }}" target="_blank" class="btn-view-details mt-2">
                                                Register Now <i class="bi bi-box-arrow-up-right"></i>
                                            </a>
                                        @endif
                                        @if(\Carbon\Carbon::parse($workshop->start_date)->isFuture())
                                            <span class="role-badge" style="background: linear-gradient(135deg, #3b82f6, #38bdf8);">Upcoming</span>
                                        @else
                                            <span class="role-badge" style="background: #6b7280;">Past</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #94a3b8; text-align: center; padding: 2rem;">No workshops scheduled yet.</p>
                    @endif
                </div>
            </div>

            <!-- Events Tab -->
            <div class="tab-pane fade" id="events" role="tabpanel">
                <div class="content-container">
                    <div class="section-title">
                        <i class="bi bi-calendar-event"></i> Events ({{ $events->count() }})
                    </div>
                    
                    @if($events->count() > 0)
                        <div class="row">
                            @foreach($events as $event)
                                <div class="col-md-12 mb-4">
                                    <div class="member-card">
                                        <h4 style="color: #60a5fa; font-size: 1.3rem; margin-bottom: 0.5rem;">
                                            {{ $event->title }}
                                            @if($event->event_type)
                                                <span class="role-badge" style="background: linear-gradient(135deg, #8b5cf6, #a78bfa); font-size: 0.8rem;">
                                                    {{ $event->event_type }}
                                                </span>
                                            @endif
                                        </h4>
                                        <p style="color: #94a3b8; margin-bottom: 1rem;">
                                            <i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y - h:i A') }}
                                            @if($event->end_date)
                                                to {{ \Carbon\Carbon::parse($event->end_date)->format('h:i A') }}
                                            @endif
                                        </p>
                                        @if($event->venue)
                                            <p style="color: #cbd5e1; margin-bottom: 1rem;">
                                                <i class="bi bi-geo-alt"></i> <strong>Venue:</strong> {{ $event->venue }}
                                            </p>
                                        @endif
                                        <p style="color: #cbd5e1; line-height: 1.6; margin-top: 1rem;">
                                            {{ $event->description }}
                                        </p>
                                        @if($event->registration_link)
                                            <a href="{{ $event->registration_link }}" target="_blank" class="btn-view-details mt-2">
                                                Register Now <i class="bi bi-box-arrow-up-right"></i>
                                            </a>
                                        @endif
                                        @if(\Carbon\Carbon::parse($event->event_date)->isFuture())
                                            <span class="role-badge" style="background: linear-gradient(135deg, #3b82f6, #38bdf8);">Upcoming</span>
                                        @else
                                            <span class="role-badge" style="background: #6b7280;">Past</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #94a3b8; text-align: center; padding: 2rem;">No events scheduled yet.</p>
                    @endif
                </div>
            </div>

            <!-- All Members Tab -->
            <div class="tab-pane fade" id="members" role="tabpanel">
                <div class="content-container">
                    <div class="section-title">
                        <i class="bi bi-people"></i> All Members ({{ $regularMembers->count() }})
                    </div>
                    
                    @if($regularMembers->count() > 0)
                        <ul class="members-list">
                            @foreach($regularMembers as $member)
                                <li>
                                    <div>
                                        <div class="member-list-name">{{ $member->student->name ?? 'N/A' }}</div>
                                        @if($member->student->student_id)
                                            <div class="member-list-role">ID: {{ $member->student->student_id }}</div>
                                        @endif
                                    </div>
                                    <span class="role-badge">{{ $member->role }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p style="color: #94a3b8; text-align: center; padding: 2rem;">No members yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
