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
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand fw-semibold">KUET CSE Admin</span>
        <div class="d-flex align-items-center gap-3">
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
</div>
</body>
</html>
