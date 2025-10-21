<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | KUET CSE</title>
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
        .card-glass {
            background: #000000 !important;
            border: 2px solid #333333;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            font-weight: 600;
        }
        .btn-primary:hover, .btn-primary:focus {
            filter: brightness(1.05);
            box-shadow: 0 6px 18px rgba(56,189,248,0.15);
        }
        .btn-outline-light {
            border-color: rgba(148, 163, 184, 0.4);
            color: #e2e8f0;
        }
        .form-control, .form-select {
            background: #000000 !important;
            border: 2px solid #555555 !important;
            color: #ffffff !important;
            font-size: 1rem;
            padding: 0.75rem;
        }
        .form-control:focus, .form-select:focus {
            background: #000000 !important;
            border-color: #ffffff !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }
        .form-control, .form-select, textarea { caret-color: #ffffff !important; }
        ::placeholder { 
            color: #cccccc !important; 
            opacity: 1 !important;
        }
        textarea::placeholder { 
            color: #cccccc !important; 
            opacity: 1 !important;
        }
        label {
            color: #ffffff !important;
            font-weight: 600;
            font-size: 1rem;
        }
        label span {
            color: #ffffff !important;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .badge-soft {
            background: #333333;
            color: #ffffff !important;
            border-radius: 999px;
            padding: 0.35rem 0.6rem;
            font-weight: 600;
            border: 1px solid #555555;
        }
        .badge-soft:hover {
            background: #555555;
            color: #ffffff !important;
        }
        .badge.bg-warning { background: #f59e0b; color: #000000; }
        .badge.bg-danger { background: #ef4444; color: #ffffff; }
        textarea {
            min-height: 110px;
            color: #ffffff !important;
            background: #000000 !important;
            border: 2px solid #555555 !important;
        }
        textarea:focus {
            background: #000000 !important;
            border-color: #ffffff !important;
            color: #ffffff !important;
        }
        a, a:hover {
            color: #ffffff;
            text-decoration: none;
        }
        .card-title { color: #ffffff !important; }
        .text-secondary { color: #cccccc !important; }
        .list-group-item { 
            border: none; 
            background: #000000 !important;
        }
        .list-group-item .fw-semibold { color: #ffffff !important; }
        .list-group-item small { color: #cccccc !important; }
        .list-group-item .d-flex a.badge { display: inline-flex; align-items:center; justify-content:center; }
        .form-check-input { width: 1.05em; height: 1.05em; }
        .form-check-label { color: #ffffff !important; }
        .section-note { color: #cccccc !important; }
        .form-section { 
            padding: 1.25rem; 
            background: #000000 !important;
        }
        .stat-card {
            background: #000000;
            border: 2px solid #333333;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            border-color: #555555;
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
        }
        .stat-card h3 {
            color: #ffffff;
            font-size: 2rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }
        .stat-card p {
            color: #cccccc;
            margin: 0;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand fw-semibold">KUET CSE Admin</span>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.academic-resources.index') }}" class="btn btn-outline-light btn-sm">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="display: inline-block; margin-right: 4px;">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
                Resources
            </a>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-light btn-sm">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="display: inline-block; margin-right: 4px;">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                </svg>
                Messages
            </a>
            <span class="text-sm text-light-emphasis">Welcome back, {{ $admin->name }}!</span>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm" type="submit">Sign out</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">
    @if(session('status'))
        <div class="alert alert-success card-glass mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card card-glass h-100">
                <div class="card-body p-0">
                    <div class="form-section">
                        <h2 class="card-title h4 mb-2">Add a Teacher Profile</h2>
                        <p class="section-note">Use this panel to publish new faculty details. Fields marked with <span>*</span> are required. Multi-line areas accept one entry per line.</p>

                        <form method="POST" action="{{ route('admin.teachers.store') }}" class="mt-3" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name <span>*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Designation <span>*</span></label>
                                <select name="designation" class="form-select @error('designation') is-invalid @enderror" required>
                                 
                                    <option value="Professor" {{ old('designation') == 'Professor' ? 'selected' : '' }}>Professor</option>
                                    <option value="Associate Professor" {{ old('designation') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                    <option value="Assistant Professor" {{ old('designation') == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                    <option value="Lecturer" {{ old('designation') == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                                </select>
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span>*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="username@teachers.gmail.com" required>
                                <small class="text-muted" style="color: #999999 !important;">Must end with @teachers.gmail.com</small>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password <span>*</span></label>
                                <input type="text" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" required>
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Availability Status <span>*</span></label>
                                <select name="availability_status" class="form-select @error('availability_status') is-invalid @enderror" required>
                                    <option value="">Select status...</option>
                                    <option value="Available" {{ old('availability_status') == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="On Leave" {{ old('availability_status') == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                                </select>
                                @error('availability_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_head" id="is_head_create" {{ old('is_head') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_head_create">
                                        Mark as Head of Department
                                    </label>
                                </div>
                                @error('is_head')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Office Room</label>
                                <input type="text" name="office_room" value="{{ old('office_room') }}" class="form-control @error('office_room') is-invalid @enderror">
                                @error('office_room')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Website URL <span class="text-secondary">(optional)</span></label>
                                <input type="url" name="website_url" value="{{ old('website_url') }}" class="form-control @error('website_url') is-invalid @enderror">
                                @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Profile Image URL <span class="text-secondary">(optional)</span></label>
                                <input type="url" name="profile_image" value="{{ old('profile_image') }}" class="form-control @error('profile_image') is-invalid @enderror" placeholder="https://">
                                @error('profile_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Short Bio <span class="text-secondary">(optional)</span></label>
                                <textarea name="short_bio" class="form-control @error('short_bio') is-invalid @enderror" rows="3">{{ old('short_bio') }}</textarea>
                                @error('short_bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Research Interests <span class="text-secondary">(optional, comma separated)</span></label>
                                <input type="text" name="research_interests" value="{{ old('research_interests') }}" class="form-control @error('research_interests') is-invalid @enderror" placeholder="AI, Data Mining, Cybersecurity">
                                @error('research_interests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Education <span class="text-secondary">(optional, one per line)</span></label>
                                <textarea name="education" class="form-control @error('education') is-invalid @enderror" placeholder="Ph.D. ...&#10;M.Sc. ...">{{ old('education') }}</textarea>
                                @error('education')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Honors & Awards <span class="text-secondary">(optional, one per line)</span></label>
                                <textarea name="honors" class="form-control @error('honors') is-invalid @enderror" placeholder="Best Paper ...">{{ old('honors') }}</textarea>
                                @error('honors')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Courses Taught <span class="text-secondary">(optional, one per line)</span></label>
                                <textarea name="courses" class="form-control @error('courses') is-invalid @enderror" placeholder="Computer Networks">{{ old('courses') }}</textarea>
                                @error('courses')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Publications Highlight <span class="text-secondary">(optional)</span></label>
                                <textarea name="publications" class="form-control @error('publications') is-invalid @enderror" rows="3" placeholder="Key publication summary...">{{ old('publications') }}</textarea>
                                @error('publications')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary px-4">Publish Teacher Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-glass h-100">
                <div class="card-body p-0">
                    <div class="form-section">
                        <h2 class="card-title h4 mb-2">Recently Added Teachers</h2>
                        <p class="section-note">A quick snapshot of the latest profiles. Click any entry to preview the public page.</p>
                        <ul class="list-group list-group-flush mt-3">
                        @forelse($recentTeachers as $teacher)
                            <li class="list-group-item bg-transparent text-light d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">{{ $teacher->name }} @if($teacher->is_head) <span class="badge bg-info ms-2">Head</span> @endif</div>
                                    <small class="text-secondary">{{ $teacher->designation }}<br>📧 {{ $teacher->email }}</small>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('teachers.show', $teacher) }}" class="badge badge-soft">View</a>
                                    <a href="{{ route('admin.teachers.edit', $teacher) }}" class="badge bg-warning text-dark">Edit</a>
                                    <form method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this teacher profile?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="badge bg-danger border-0">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item bg-transparent text-secondary">No teacher profiles yet. Start by publishing one!</li>
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notice Management Section -->
    <div class="row g-4 mt-4">
        <div class="col-lg-7">
            <div class="card card-glass h-100">
                <div class="card-body p-0">
                    <div class="form-section">
                        <h2 class="card-title h4 mb-2">Publish a Notice</h2>
                        <p class="section-note">Use this panel to publish notices for students and visitors. All fields are required.</p>

                        <form method="POST" action="{{ route('admin.notices.store') }}" class="mt-3">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Notice Title <span>*</span></label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" required>
                                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Notice Content <span>*</span></label>
                                    <textarea name="content" rows="6" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary px-4">Publish Notice</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-glass h-100">
                <div class="card-body p-0">
                    <div class="form-section">
                        <h2 class="card-title h4 mb-2">Recently Published Notices</h2>
                        <p class="section-note">Manage your published notices. Edit or delete as needed.</p>
                        <ul class="list-group list-group-flush mt-3">
                            @forelse($recentNotices as $notice)
                                <li class="list-group-item bg-transparent d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="fw-semibold">{{ $notice->title }}</div>
                                        <small>{{ $notice->created_at->format('M d, Y h:i A') }}</small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('notices.show', $notice) }}" class="badge badge-soft">View</a>
                                        <a href="{{ route('admin.notices.edit', $notice) }}" class="badge bg-warning text-dark">Edit</a>
                                        <form method="POST" action="{{ route('admin.notices.destroy', $notice) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this notice?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge bg-danger border-0">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item bg-transparent text-secondary">No notices published yet. Start by creating one!</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Academic Resources Management Section -->
    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body p-0">
                    <div class="form-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="card-title h4 mb-1">Manage Academic Resources</h2>
                                <p class="section-note mb-0">Add and manage course materials, syllabi, and academic calendars for students</p>
                            </div>
                            <a href="{{ route('admin.academic-resources.index') }}" class="btn btn-primary">
                                <i class="bi bi-gear-fill me-1"></i> Full Management Panel
                            </a>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <!-- Quick Stats -->
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="bi bi-folder-fill text-primary" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\AcademicResource::where('category', 'course_material')->where('is_active', true)->count() }}</h3>
                                    <p>Course Materials</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="bi bi-book-fill text-success" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\AcademicResource::where('category', 'syllabus')->where('is_active', true)->count() }}</h3>
                                    <p>Syllabi</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                    <i class="bi bi-calendar-event-fill text-info" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\AcademicResource::where('category', 'academic_calendar')->where('is_active', true)->count() }}</h3>
                                    <p>Academic Calendars</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Batch Management Quick Link -->
                        <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong style="color: #60a5fa;"><i class="bi bi-calendar2-range me-2"></i>Batch Management</strong>
                                    <p class="mb-0 small text-muted">Manage batches ({{ \App\Models\Batch::count() }} total) - organize resources by year</p>
                                </div>
                                <a href="{{ route('admin.batches.index') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-gear me-1"></i> Manage Batches
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Career Opportunities Management Section -->
    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body p-0">
                    <div class="form-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="card-title h4 mb-1">Manage Career Opportunities</h2>
                                <p class="section-note mb-0">Post internships and job opportunities for students</p>
                            </div>
                            <a href="{{ route('admin.career-opportunities.index') }}" class="btn btn-primary">
                                <i class="bi bi-gear-fill me-1"></i> Full Management Panel
                            </a>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <!-- Quick Stats -->
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-briefcase-fill text-primary" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\CareerOpportunity::where('is_active', true)->count() }}</h3>
                                    <p>Active Opportunities</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-award-fill text-success" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\CareerOpportunity::where('job_type', 'internship')->where('is_active', true)->count() }}</h3>
                                    <p>Internships</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-file-earmark-check-fill text-info" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\CareerOpportunity::where('job_type', 'full-time')->where('is_active', true)->count() }}</h3>
                                    <p>Full-Time Jobs</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-clock-fill text-warning" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\CareerOpportunity::where('job_type', 'part-time')->where('is_active', true)->count() }}</h3>
                                    <p>Part-Time Jobs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Academic Programs Management Section -->
    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body p-0">
                    <div class="form-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="card-title h4 mb-1">Manage Academic Programs</h2>
                                <p class="section-note mb-0">Manage degree programs, curriculum, and learning outcomes</p>
                            </div>
                            <a href="{{ route('admin.programs.index') }}" class="btn btn-primary">
                                <i class="bi bi-mortarboard-fill me-1"></i> Full Management Panel
                            </a>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <!-- Quick Stats -->
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-mortarboard-fill text-primary" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Program::where('is_active', true)->count() }}</h3>
                                    <p>Active Programs</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-bookmark-fill text-success" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Program::where('degree_type', 'undergraduate')->where('is_active', true)->count() }}</h3>
                                    <p>Undergraduate</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-award-fill text-info" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Program::where('degree_type', 'postgraduate')->where('is_active', true)->count() }}</h3>
                                    <p>Postgraduate</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-list-check text-warning" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\ProgramOutcome::count() }}</h3>
                                    <p>Learning Outcomes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Management Section -->
    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body p-0">
                    <div class="form-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="card-title h4 mb-1">Manage Students</h2>
                                <p class="section-note mb-0">Add and manage student accounts for the portal</p>
                            </div>
                            <a href="{{ route('admin.students.index') }}" class="btn btn-primary">
                                <i class="bi bi-people-fill me-1"></i> Full Management Panel
                            </a>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <!-- Quick Stats by Batch -->
                            @foreach(\App\Models\Batch::sorted('desc')->get() as $batch)
                            <div class="col-md-2">
                                <div class="stat-card">
                                    <i class="bi bi-person-badge text-primary" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Student::where('batch', $batch->name)->count() }}</h3>
                                    <p>{{ $batch->name }} Students</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Courses Section -->
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body p-0">
                    <div class="form-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="card-title h4 mb-1">Manage Courses</h2>
                                <p class="section-note mb-0">Add and manage courses for each semester</p>
                            </div>
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">
                                <i class="bi bi-book-fill me-1"></i> Full Course Management
                            </a>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <!-- Quick Stats by Semester -->
                            @foreach(['1-1', '1-2', '2-1', '2-2', '3-1', '3-2', '4-1', '4-2'] as $semester)
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-journal-code text-success" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Course::where('semester', $semester)->count() }}</h3>
                                    <p>Semester {{ $semester }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Clubs Section -->
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body p-0">
                    <div class="form-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="card-title h4 mb-1">Manage Student Clubs</h2>
                                <p class="section-note mb-0">Add and manage student clubs, members, workshops, and events</p>
                            </div>
                            <a href="{{ route('admin.clubs.index') }}" class="btn btn-primary">
                                <i class="bi bi-people-fill me-1"></i> Full Clubs Management
                            </a>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <!-- Quick Stats -->
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-people text-primary" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Club::count() }}</h3>
                                    <p>Total Clubs</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Club::where('is_active', true)->count() }}</h3>
                                    <p>Active Clubs</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-person-badge text-info" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\ClubMember::count() }}</h3>
                                    <p>Total Members</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-book text-warning" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\ClubWorkshop::count() }}</h3>
                                    <p>Workshops</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-calendar-event text-danger" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\ClubEvent::count() }}</h3>
                                    <p>Club Events</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Events Section -->
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body p-0">
                    <div class="form-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="card-title h4 mb-1">Manage Department Events</h2>
                                <p class="section-note mb-0">Schedule and manage department-wide events, workshops, seminars, and competitions</p>
                            </div>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-primary">
                                <i class="bi bi-calendar-event-fill me-1"></i> Full Events Management
                            </a>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <!-- Quick Stats -->
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-calendar-event text-purple" style="font-size: 2rem; color: #a78bfa;"></i>
                                    <h3>{{ \App\Models\Event::count() }}</h3>
                                    <p>Total Events</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-calendar-check text-primary" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Event::active()->upcoming()->count() }}</h3>
                                    <p>Upcoming Events</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-clock-history text-secondary" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Event::active()->past()->count() }}</h3>
                                    <p>Past Events</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-star-fill text-warning" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\Event::active()->featured()->count() }}</h3>
                                    <p>Featured Events</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manage Results Section -->
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body p-0">
                    <div class="form-section">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h2 class="card-title h4 mb-1">Manage Student Results</h2>
                                <p class="section-note mb-0">Add and manage student results/grades for each semester</p>
                            </div>
                            <a href="{{ route('admin.results.index') }}" class="btn btn-primary">
                                <i class="bi bi-clipboard-data-fill me-1"></i> Full Results Management
                            </a>
                        </div>
                        
                        <div class="row g-4 mt-2">
                            <!-- Quick Stats -->
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-mortarboard text-warning" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\StudentResult::distinct('student_id')->count('student_id') }}</h3>
                                    <p>Students with Results</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-file-earmark-text text-info" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\StudentResult::count() }}</h3>
                                    <p>Total Results</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-award text-success" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\StudentResult::whereIn('grade', ['A+', 'A'])->count() }}</h3>
                                    <p>A/A+ Grades</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 2rem;"></i>
                                    <h3>{{ \App\Models\StudentResult::where('grade', 'F')->count() }}</h3>
                                    <p>Failed Results</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

