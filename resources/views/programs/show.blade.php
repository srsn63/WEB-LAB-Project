<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program->name }} - KUET CSE Department</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .badge-custom {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 20px;
            margin: 0 0.5rem;
        }

        .badge-undergraduate {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }

        .badge-postgraduate {
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
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

        .content-container {
            background: #000000;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
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

        .objectives-list, .outcomes-list {
            list-style: none;
            padding: 0;
        }

        .objectives-list li, .outcomes-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: start;
            gap: 1rem;
        }

        .objectives-list li:last-child, .outcomes-list li:last-child {
            border-bottom: none;
        }

        .objectives-list li i {
            color: #60a5fa;
            margin-top: 0.3rem;
        }

        .outcome-number {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .accordion-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
            border-radius: 8px;
            overflow: hidden;
        }

        .accordion-button {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            font-weight: 600;
            padding: 1.25rem;
            border: none;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: #ffffff;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border: none;
        }

        .accordion-button::after {
            filter: brightness(0) invert(1);
        }

        .accordion-body {
            background: rgba(0, 0, 0, 0.3);
            color: #e2e8f0;
            padding: 1.5rem;
        }

        .semester-section {
            margin-bottom: 2rem;
        }

        .semester-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #60a5fa;
            margin-bottom: 1rem;
            padding-left: 1rem;
            border-left: 3px solid #60a5fa;
        }

        .course-table {
            width: 100%;
            margin-bottom: 1.5rem;
        }

        .course-table th {
            background: rgba(96, 165, 250, 0.2);
            color: #60a5fa;
            padding: 0.75rem;
            font-weight: 600;
            border: none;
        }

        .course-table td {
            padding: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .course-table tr:last-child td {
            border-bottom: none;
        }

        .badge-mandatory {
            background: #10b981;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.85rem;
        }

        .badge-elective {
            background: #f59e0b;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.85rem;
        }

        .credit-summary {
            background: rgba(96, 165, 250, 0.1);
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .coordinator-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .coordinator-card h5 {
            color: #60a5fa;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .coordinator-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .coordinator-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            font-weight: 700;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            border: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            color: white;
        }

        .btn-secondary-custom {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary-custom:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .career-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .career-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }

        .career-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: #60a5fa;
            transform: translateY(-3px);
        }

        .career-card i {
            font-size: 2rem;
            color: #60a5fa;
            margin-bottom: 1rem;
        }

        .career-card h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .admission-steps {
            counter-reset: step-counter;
        }

        .admission-step {
            position: relative;
            padding-left: 4rem;
            margin-bottom: 2rem;
        }

        .admission-step::before {
            counter-increment: step-counter;
            content: counter(step-counter);
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .admission-step h5 {
            color: #60a5fa;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .back-button {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #60a5fa;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid rgba(96, 165, 250, 0.3);
        }

        @media (max-width: 768px) {
            .hero-header h1 {
                font-size: 1.75rem;
            }

            .info-cards {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Header -->
    <div class="hero-header">
        <div class="container">
            <div class="back-button">
                <a href="{{ route('programs.index') }}" class="btn btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i> Back to Programs
                </a>
            </div>
            <h1>{{ $program->name }}</h1>
            <p class="lead">{{ $program->short_name }}</p>
            <div>
                <span class="badge badge-custom badge-{{ $program->degree_type }}">
                    {{ ucfirst($program->degree_type) }}
                </span>
                @if($program->is_active)
                    <span class="badge badge-custom" style="background: #10b981;">
                        <i class="fas fa-check-circle"></i> Active
                    </span>
                @endif
            </div>
            <div class="info-cards">
                <div class="info-card">
                    <i class="fas fa-clock"></i>
                    <div>
                        <small style="opacity: 0.8;">Duration</small>
                        <div style="font-weight: 600;">{{ $program->duration }}</div>
                    </div>
                </div>
                <div class="info-card">
                    <i class="fas fa-award"></i>
                    <div>
                        <small style="opacity: 0.8;">Total Credits</small>
                        <div style="font-weight: 600;">{{ $program->total_credits }}</div>
                    </div>
                </div>
                @if($mandatoryCredits > 0)
                <div class="info-card">
                    <i class="fas fa-bookmark"></i>
                    <div>
                        <small style="opacity: 0.8;">Mandatory</small>
                        <div style="font-weight: 600;">{{ $mandatoryCredits }} Credits</div>
                    </div>
                </div>
                @endif
                @if($electiveCredits > 0)
                <div class="info-card">
                    <i class="fas fa-star"></i>
                    <div>
                        <small style="opacity: 0.8;">Elective</small>
                        <div style="font-weight: 600;">{{ $electiveCredits }} Credits</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <!-- Coordinator Card -->
        @if($program->coordinator)
        <div class="coordinator-card">
            <h5><i class="fas fa-user-tie"></i> Program Coordinator</h5>
            <div class="coordinator-info">
                <div class="coordinator-avatar">
                    {{ substr($program->coordinator->name, 0, 1) }}
                </div>
                <div>
                    <h6 style="margin: 0; font-weight: 600;">{{ $program->coordinator->name }}</h6>
                    @if($program->coordinator->designation)
                        <small style="opacity: 0.7;">{{ $program->coordinator->designation }}</small>
                    @endif
                    @if($program->coordinator->email)
                        <div style="margin-top: 0.5rem;">
                            <a href="mailto:{{ $program->coordinator->email }}" style="color: #60a5fa; text-decoration: none;">
                                <i class="fas fa-envelope"></i> {{ $program->coordinator->email }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="mailto:admission@kuet.ac.bd?subject=Inquiry about {{ $program->short_name }}" class="btn-action btn-primary-custom">
                <i class="fas fa-envelope"></i> Contact Admissions
            </a>
            @if($program->coordinator && $program->coordinator->email)
            <a href="mailto:{{ $program->coordinator->email }}?subject=Inquiry about {{ $program->short_name }}" class="btn-action btn-secondary-custom">
                <i class="fas fa-user-tie"></i> Contact Coordinator
            </a>
            @endif
            <a href="{{ url('/') }}" class="btn-action btn-secondary-custom">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>

        <!-- Tabs Navigation -->
        <div class="content-container">
            <ul class="nav nav-tabs" id="programTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
                        <i class="fas fa-info-circle"></i> Overview
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab">
                        <i class="fas fa-book"></i> Curriculum
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="outcomes-tab" data-bs-toggle="tab" data-bs-target="#outcomes" type="button" role="tab">
                        <i class="fas fa-graduation-cap"></i> Learning Outcomes
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="career-tab" data-bs-toggle="tab" data-bs-target="#career" type="button" role="tab">
                        <i class="fas fa-briefcase"></i> Career Prospects
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="admission-tab" data-bs-toggle="tab" data-bs-target="#admission" type="button" role="tab">
                        <i class="fas fa-file-alt"></i> Admission
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="programTabsContent">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                    <h3 class="section-title">About This Program</h3>
                    <p style="line-height: 1.8; font-size: 1.05rem;">{{ $program->description }}</p>

                    @if($program->objectives)
                    <h3 class="section-title mt-5">Program Objectives</h3>
                    <ul class="objectives-list">
                        @foreach(explode("\n", $program->objectives) as $objective)
                            @if(trim($objective) && trim($objective) !== '•')
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ trim(str_replace('•', '', $objective)) }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @endif
                </div>

                <!-- Curriculum Tab -->
                <div class="tab-pane fade" id="curriculum" role="tabpanel">
                    <h3 class="section-title">Program Curriculum</h3>
                    
                    @if(count($coursesByYearSemester) > 0)
                        <div class="accordion" id="curriculumAccordion">
                            @for($year = 1; $year <= 4; $year++)
                                @php
                                    $yearCredits = $creditsByYear[$year] ?? 0;
                                    $yearHasCourses = false;
                                    foreach([1, 2] as $sem) {
                                        if(isset($coursesByYearSemester[$year][$sem]) && count($coursesByYearSemester[$year][$sem]) > 0) {
                                            $yearHasCourses = true;
                                            break;
                                        }
                                    }
                                @endphp
                                
                                @if($yearHasCourses)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-year-{{ $year }}">
                                        <button class="accordion-button {{ $year > 1 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-year-{{ $year }}">
                                            Year {{ $year }} - {{ $yearCredits }} Credits
                                        </button>
                                    </h2>
                                    <div id="collapse-year-{{ $year }}" class="accordion-collapse collapse {{ $year === 1 ? 'show' : '' }}" data-bs-parent="#curriculumAccordion">
                                        <div class="accordion-body">
                                            @foreach([1, 2] as $semester)
                                                @php
                                                    $courses = $coursesByYearSemester[$year][$semester] ?? [];
                                                @endphp
                                                
                                                @if(count($courses) > 0)
                                                <div class="semester-section">
                                                    <div class="semester-title">
                                                        <i class="fas fa-calendar-alt"></i> Semester {{ $semester }}
                                                    </div>
                                                    <table class="course-table">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 20%;">Course Code</th>
                                                                <th style="width: 50%;">Course Name</th>
                                                                <th style="width: 15%;">Credits</th>
                                                                <th style="width: 15%;">Type</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($courses as $courseData)
                                                                <tr>
                                                                    <td><strong>{{ $courseData['course']->course_code }}</strong></td>
                                                                    <td>{{ $courseData['course']->course_name }}</td>
                                                                    <td>{{ $courseData['course']->credits }}</td>
                                                                    <td>
                                                                        @if($courseData['is_mandatory'])
                                                                            <span class="badge-mandatory">Mandatory</span>
                                                                        @else
                                                                            <span class="badge-elective">Elective</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @endif
                                            @endforeach
                                            
                                            <div class="credit-summary">
                                                <strong><i class="fas fa-calculator"></i> Year {{ $year }} Total:</strong>
                                                <strong>{{ $yearCredits }} Credits</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endfor
                        </div>
                    @else
                        <div class="alert alert-info" style="background: rgba(96, 165, 250, 0.1); border: 1px solid rgba(96, 165, 250, 0.3); color: #60a5fa;">
                            <i class="fas fa-info-circle"></i> Detailed curriculum information will be available soon. Course structure is currently being finalized.
                        </div>
                    @endif
                </div>

                <!-- Learning Outcomes Tab -->
                <div class="tab-pane fade" id="outcomes" role="tabpanel">
                    <h3 class="section-title">Program Learning Outcomes</h3>
                    <p style="margin-bottom: 2rem; font-size: 1.05rem;">Upon successful completion of this program, graduates will be able to:</p>
                    
                    @if($program->outcomes->count() > 0)
                        <ul class="outcomes-list">
                            @foreach($program->outcomes as $outcome)
                                <li>
                                    <div class="outcome-number">{{ $loop->iteration }}</div>
                                    <div style="flex: 1;">{{ $outcome->outcome_text }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info" style="background: rgba(96, 165, 250, 0.1); border: 1px solid rgba(96, 165, 250, 0.3); color: #60a5fa;">
                            <i class="fas fa-info-circle"></i> Program learning outcomes are currently being finalized.
                        </div>
                    @endif
                </div>

                <!-- Career Prospects Tab -->
                <div class="tab-pane fade" id="career" role="tabpanel">
                    <h3 class="section-title">Career Prospects</h3>
                    
                    @if($program->career_prospects)
                        <div style="line-height: 1.8; font-size: 1.05rem; white-space: pre-line;">{{ $program->career_prospects }}</div>
                    @else
                        <p style="line-height: 1.8; font-size: 1.05rem;">
                            Graduates from this program have excellent career opportunities in both national and international markets. 
                            Our alumni work in leading technology companies, research institutions, and academic positions worldwide.
                        </p>
                    @endif

                    <div class="career-grid">
                        <div class="career-card">
                            <i class="fas fa-laptop-code"></i>
                            <h5>Software Development</h5>
                            <p style="font-size: 0.9rem; opacity: 0.8;">Full-stack developers, mobile app developers, software engineers</p>
                        </div>
                        <div class="career-card">
                            <i class="fas fa-chart-line"></i>
                            <h5>Data Science & AI</h5>
                            <p style="font-size: 0.9rem; opacity: 0.8;">Data scientists, ML engineers, AI specialists</p>
                        </div>
                        <div class="career-card">
                            <i class="fas fa-shield-alt"></i>
                            <h5>Cybersecurity</h5>
                            <p style="font-size: 0.9rem; opacity: 0.8;">Security analysts, ethical hackers, security architects</p>
                        </div>
                        <div class="career-card">
                            <i class="fas fa-cloud"></i>
                            <h5>Cloud & DevOps</h5>
                            <p style="font-size: 0.9rem; opacity: 0.8;">Cloud architects, DevOps engineers, system administrators</p>
                        </div>
                        <div class="career-card">
                            <i class="fas fa-microscope"></i>
                            <h5>Research & Academia</h5>
                            <p style="font-size: 0.9rem; opacity: 0.8;">Research scientists, university faculty, PhD candidates</p>
                        </div>
                        <div class="career-card">
                            <i class="fas fa-lightbulb"></i>
                            <h5>Entrepreneurship</h5>
                            <p style="font-size: 0.9rem; opacity: 0.8;">Tech startup founders, innovation leaders, consultants</p>
                        </div>
                    </div>
                </div>

                <!-- Admission Tab -->
                <div class="tab-pane fade" id="admission" role="tabpanel">
                    <h3 class="section-title">Admission Requirements</h3>
                    
                    @if($program->admission_requirements)
                        <div style="line-height: 1.8; font-size: 1.05rem; white-space: pre-line; margin-bottom: 3rem;">{{ $program->admission_requirements }}</div>
                    @else
                        <p style="line-height: 1.8; font-size: 1.05rem; margin-bottom: 3rem;">
                            For detailed admission requirements and application procedures, please contact the admissions office or visit the official KUET website.
                        </p>
                    @endif

                    <div class="alert alert-info" style="background: rgba(96, 165, 250, 0.15); border: 1px solid rgba(96, 165, 250, 0.4); color: #ffffff; padding: 1.5rem; border-radius: 10px;">
                        <h5 style="color: #60a5fa; margin-bottom: 1rem;">
                            <i class="fas fa-info-circle"></i> Need Help with Application?
                        </h5>
                        <p style="margin-bottom: 1rem;">For admission inquiries and application assistance, please reach out to:</p>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <div><i class="fas fa-envelope"></i> <strong>Email:</strong> admission@kuet.ac.bd</div>
                            <div><i class="fas fa-phone"></i> <strong>Phone:</strong> +880-41-769468-79</div>
                            <div><i class="fas fa-globe"></i> <strong>Website:</strong> <a href="https://www.kuet.ac.bd" target="_blank" style="color: #60a5fa;">www.kuet.ac.bd</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
