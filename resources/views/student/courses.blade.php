<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses | KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #000000;
            color: #e2e8f0;
            overflow-x: hidden;
        }
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #0a0e27 0%, #1a1f3a 100%);
            border-right: 2px solid rgba(96, 165, 250, 0.2);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(96, 165, 250, 0.2);
        }
        .sidebar-header h3 {
            color: #60a5fa;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .sidebar-header p {
            color: #94a3b8;
            font-size: 0.85rem;
        }
        .sidebar-menu {
            padding: 1.5rem 0;
        }
        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        .menu-item i {
            font-size: 1.25rem;
            margin-right: 1rem;
            color: #60a5fa;
        }
        .menu-item:hover {
            background: rgba(96, 165, 250, 0.1);
            color: #60a5fa;
            border-left-color: #60a5fa;
        }
        .menu-item.active {
            background: rgba(96, 165, 250, 0.15);
            color: #60a5fa;
            border-left-color: #60a5fa;
            font-weight: 600;
        }
        .menu-item.coming-soon {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .logout-btn {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: #f87171;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            margin-top: 1rem;
        }
        .logout-btn i {
            font-size: 1.25rem;
            margin-right: 1rem;
        }
        .logout-btn:hover {
            background: rgba(248, 113, 113, 0.1);
            color: #f87171;
            border-left-color: #f87171;
        }
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
        }
        .top-bar {
            background: rgba(10, 14, 39, 0.95);
            border: 1px solid rgba(96, 165, 250, 0.2);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .welcome-text h1 {
            color: #60a5fa;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .welcome-text p {
            color: #94a3b8;
            font-size: 0.9rem;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .course-card {
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 100%);
            border: 2px solid rgba(96, 165, 250, 0.2);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        .course-card:hover {
            border-color: #60a5fa;
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(96, 165, 250, 0.2);
        }
        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }
        .course-code {
            background: linear-gradient(135deg, #2563eb, #60a5fa);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
        }
        .course-credits {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .course-name {
            color: #e2e8f0;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .course-description {
            color: #94a3b8;
            font-size: 0.9rem;
            line-height: 1.6;
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #94a3b8;
        }
        .empty-state i {
            font-size: 4rem;
            color: #60a5fa;
            margin-bottom: 1rem;
        }
        .empty-state h3 {
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }
        .stats-badge {
            display: inline-block;
            background: rgba(96, 165, 250, 0.2);
            color: #60a5fa;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .course-results {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(96, 165, 250, 0.2);
        }
        .course-results h5 {
            color: #60a5fa;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        .result-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            background: rgba(96, 165, 250, 0.05);
            border-radius: 6px;
        }
        .result-type {
            font-size: 0.85rem;
            color: #94a3b8;
            text-transform: uppercase;
        }
        .result-marks {
            font-size: 0.85rem;
            color: #cbd5e1;
        }
        .result-grade {
            font-weight: 700;
            font-size: 1rem;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
        }
        .grade-a-plus { background: #10b981; color: white; }
        .grade-a { background: #22c55e; color: white; }
        .grade-a-minus { background: #84cc16; color: white; }
        .grade-b { background: #eab308; color: #000; }
        .grade-c { background: #f97316; color: white; }
        .grade-d { background: #ef4444; color: white; }
        .grade-f { background: #dc2626; color: white; }
        .no-results {
            color: #64748b;
            font-size: 0.85rem;
            font-style: italic;
            padding: 0.5rem;
            text-align: center;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3>Student Portal</h3>
                <p>KUET CSE Department</p>
            </div>
            <nav class="sidebar-menu">
                <a href="{{ route('student.dashboard') }}" class="menu-item">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.courses') }}" class="menu-item active">
                    <i class="bi bi-book"></i>
                    <span>My Courses</span>
                </a>
                <a href="{{ route('student.courses') }}" class="menu-item active">
                    <i class="bi bi-clipboard-data"></i>
                    <span>Results</span>
                </a>
                
                <div style="border-top: 1px solid rgba(96, 165, 250, 0.2); margin: 1rem 0;"></div>
                <a href="{{ route('academic-resources.index') }}" class="menu-item">
                    <i class="bi bi-journal-text"></i>
                    <span>Academic Resources</span>
                </a>
              
               
                <form method="POST" action="{{ route('student.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn w-100 border-0 bg-transparent text-start">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-bar">
                <div class="welcome-text">
                    <h1>My Courses</h1>
                    <p>Semester {{ $student->current_semester ?? 'N/A' }} - {{ $student->batch }}</p>
                </div>
                <div class="user-info">
                    <span style="color: #94a3b8;">{{ $student->name }}</span>
                    <form method="POST" action="{{ route('student.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            @if($courses->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h3>No Courses Available</h3>
                    <p>No courses have been added for Semester {{ $student->current_semester ?? 'N/A' }} yet.</p>
                    <p style="margin-top: 1rem;">Please contact your administrator or check back later.</p>
                </div>
            @else
                <div class="stats-badge">
                    <i class="bi bi-book-fill me-2"></i>
                    {{ $courses->count() }} Course(s) this semester
                </div>

                <div class="courses-grid">
                    @foreach($courses as $course)
                        <div class="course-card">
                            <div class="course-header">
                                <div class="course-code">{{ $course->course_code }}</div>
                                <div class="course-credits">{{ $course->credits }} Credits</div>
                            </div>
                            <div class="course-name">{{ $course->course_name }}</div>
                            @if($course->description)
                                <div class="course-description">{{ $course->description }}</div>
                            @endif
                            
                            @if(isset($courseResults[$course->id]) && $courseResults[$course->id]->count() > 0)
                                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(96, 165, 250, 0.2);">
                                    <div style="color: #60a5fa; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">
                                        <i class="bi bi-clipboard-data me-1"></i> Results
                                    </div>
                                    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                                        @foreach($courseResults[$course->id] as $result)
                                            <div style="background: rgba(96, 165, 250, 0.1); padding: 0.5rem 0.75rem; border-radius: 8px; flex: 1; min-width: 120px;">
                                                <div style="font-size: 0.75rem; color: #94a3b8; margin-bottom: 0.25rem;">{{ ucfirst($result->exam_type) }}</div>
                                                <div style="font-weight: 700; color: {{ $result->grade == 'F' ? '#ef4444' : '#10b981' }}; font-size: 1.1rem;">
                                                    {{ $result->grade }} <span style="font-size: 0.85rem; color: #94a3b8;">({{ $result->grade_point }})</span>
                                                </div>
                                                <div style="font-size: 0.75rem; color: #94a3b8;">{{ $result->marks_obtained }}/{{ $result->total_marks }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div style="margin-top: 1rem; padding: 0.75rem; background: rgba(107, 114, 128, 0.1); border-radius: 8px; text-align: center;">
                                    <small style="color: #9ca3af;"><i class="bi bi-info-circle me-1"></i> No results available yet</small>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
