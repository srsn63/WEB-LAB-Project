<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | KUET CSE</title>
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
            margin: 0;
        }
        .user-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .user-info {
            text-align: right;
        }
        .user-info .name {
            color: #e2e8f0;
            font-weight: 600;
        }
        .user-info .id {
            color: #94a3b8;
            font-size: 0.875rem;
        }
        .btn-logout {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
        }
        /* Profile Card */
        .profile-card {
            background: rgba(10, 14, 39, 0.95);
            border: 2px solid rgba(96, 165, 250, 0.2);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .profile-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #60a5fa;
            object-fit: cover;
            background: rgba(96, 165, 250, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-avatar i {
            font-size: 4rem;
            color: #60a5fa;
        }
        .profile-info h2 {
            color: #e2e8f0;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .profile-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
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
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .stat-box {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(96, 165, 250, 0.2);
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }
        .stat-box:hover {
            transform: translateY(-4px);
            border-color: #60a5fa;
            box-shadow: 0 8px 20px rgba(96, 165, 250, 0.2);
        }
        .stat-box h3 {
            color: #60a5fa;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .stat-box p {
            color: #cbd5e1;
            margin: 0;
        }
        /* Quick Links */
        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .quick-link-card {
            background: rgba(10, 14, 39, 0.95);
            border: 2px solid rgba(96, 165, 250, 0.2);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .quick-link-card:hover {
            transform: translateY(-4px);
            border-color: #60a5fa;
            box-shadow: 0 8px 20px rgba(96, 165, 250, 0.3);
        }
        .quick-link-card i {
            font-size: 2.5rem;
            color: #60a5fa;
            margin-bottom: 1rem;
        }
        .quick-link-card h4 {
            color: #e2e8f0;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .quick-link-card p {
            color: #94a3b8;
            font-size: 0.875rem;
            margin: 0;
        }
        .quick-link-card.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .quick-link-card.disabled:hover {
            transform: none;
        }
        .badge-coming-soon {
            background: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 0.5rem;
            display: inline-block;
        }
        .alert {
            border-radius: 12px;
            border: none;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.3);
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
                <a href="{{ route('student.dashboard') }}" class="menu-item active">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('student.courses') }}" class="menu-item">
                    <i class="bi bi-book"></i>
                    <span>My Courses</span>
                </a>
                <a href="{{ route('student.courses') }}" class="menu-item">
                    <i class="bi bi-card-checklist"></i>
                    <span>Results</span>
                </a>
              
                <a href="{{ route('academic-resources.index') }}" class="menu-item">
                    <i class="bi bi-folder"></i>
                    <span>Academic Resources</span>
                </a>
                
                <form method="POST" action="{{ route('student.logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="menu-item w-100 border-0 bg-transparent text-start">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="welcome-text">
                    <h1>Welcome Back, {{ $student->name }}!</h1>
                    <p>Student ID: {{ $student->student_id }} | Batch: {{ $student->batch }}</p>
                </div>
                <div class="user-actions">
                    <div class="user-info">
                        <div class="name">{{ $student->name }}</div>
                        <div class="id">{{ $student->student_id }}</div>
                    </div>
                    <form method="POST" action="{{ route('student.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-logout">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success mb-3">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        @if($student->profile_picture)
                            <img src="{{ $student->profile_picture }}" alt="{{ $student->name }}">
                        @else
                            <i class="bi bi-person-circle"></i>
                        @endif
                    </div>
                    <div class="profile-info">
                        <h2>{{ $student->name }}</h2>
                        <div class="profile-meta">
                            <div class="meta-item">
                                <i class="bi bi-credit-card-2-front"></i>
                                <span>{{ $student->student_id }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $student->batch }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-envelope"></i>
                                <span>{{ $student->email }}</span>
                            </div>
                            @if($student->phone)
                            <div class="meta-item">
                                <i class="bi bi-telephone"></i>
                                <span>{{ $student->phone }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-box">
                        <h3>{{ number_format($student->cgpa, 2) }}</h3>
                        <p>Overall CGPA</p>
                    </div>
                    <div class="stat-box">
                        <h3>{{ $semesterGPA > 0 ? number_format($semesterGPA, 2) : 'N/A' }}</h3>
                        <p>Semester GPA</p>
                    </div>
                    <div class="stat-box">
                        <h3>{{ $student->current_semester ?? 'N/A' }}</h3>
                        <p>Current Semester</p>
                    </div>
                    <div class="stat-box">
                        <h3>{{ $student->is_active ? 'Active' : 'Inactive' }}</h3>
                        <p>Account Status</p>
                    </div>
                </div>
            </div>

            <!-- Recent Results -->
            @if($recentResults->count() > 0)
            <h3 style="color: #60a5fa; margin: 2rem 0 1rem;">Recent Results</h3>
            <div class="card" style="background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 100%); border: 2px solid rgba(96, 165, 250, 0.2); border-radius: 15px; padding: 1.5rem; margin-bottom: 2rem;">
                <div class="table-responsive">
                    <table style="width: 100%; color: #e2e8f0;">
                        <thead>
                            <tr style="border-bottom: 2px solid rgba(96, 165, 250, 0.2);">
                                <th style="padding: 0.75rem; text-align: left;">Course</th>
                                <th style="padding: 0.75rem; text-align: center;">Exam</th>
                                <th style="padding: 0.75rem; text-align: center;">Marks</th>
                                <th style="padding: 0.75rem; text-align: center;">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentResults as $result)
                            <tr style="border-bottom: 1px solid rgba(96, 165, 250, 0.1);">
                                <td style="padding: 0.75rem;">
                                    <strong style="color: #60a5fa;">{{ $result->course->course_code }}</strong><br>
                                    <small style="color: #94a3b8;">{{ Str::limit($result->course->course_name, 30) }}</small>
                                </td>
                                <td style="padding: 0.75rem; text-align: center;">
                                    <span style="background: rgba(96, 165, 250, 0.2); padding: 0.25rem 0.75rem; border-radius: 6px; font-size: 0.85rem;">
                                        {{ ucfirst($result->exam_type) }}
                                    </span>
                                </td>
                                <td style="padding: 0.75rem; text-align: center;">
                                    {{ $result->marks_obtained }}/{{ $result->total_marks }}<br>
                                    <small style="color: #94a3b8;">({{ round(($result->marks_obtained/$result->total_marks)*100, 2) }}%)</small>
                                </td>
                                <td style="padding: 0.75rem; text-align: center;">
                                    <strong style="color: {{ $result->grade == 'F' ? '#ef4444' : '#10b981' }}; font-size: 1.1rem;">
                                        {{ $result->grade }}
                                    </strong><br>
                                    <small style="color: #94a3b8;">{{ $result->grade_point }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- Quick Links -->
            <h3 style="color: #60a5fa; margin-bottom: 1rem;">Quick Access</h3>
            <div class="quick-links">
                <a href="{{ route('academic-resources.index') }}" class="quick-link-card">
                    <i class="bi bi-folder-fill"></i>
                    <h4>Academic Resources</h4>
                    <p>Access course materials and syllabi</p>
                </a>
                <a href="{{ route('student.courses') }}" class="quick-link-card">
                    <i class="bi bi-book-fill"></i>
                    <h4>My Courses</h4>
                    <p>View enrolled courses</p>
                </a>
                <a href="{{ route('student.courses') }}" class="quick-link-card">
                    <i class="bi bi-award-fill"></i>
                    <h4>View Results</h4>
                    <p>Check your academic performance</p>
                </a>
                <a href="{{ route('home') }}" class="quick-link-card">
                    <i class="bi bi-house-door-fill"></i>
                    <h4>Department Website</h4>
                    <p>Visit CSE homepage</p>
                </a>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
