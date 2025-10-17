<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher Profile | KUET CSE Admin</title>
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
        .btn-secondary {
            background: #333333;
            border: 1px solid #ffffff;
            color: #ffffff;
        }
        .btn-secondary:hover {
            background: #555555;
            color: #ffffff;
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
        .alert {
            border-radius: 12px;
            border: 2px solid #333333;
            background: #000000 !important;
            color: #ffffff !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand fw-semibold">KUET CSE Admin</span>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">Back to Dashboard</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    @if(session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-glass">
                <div class="card-body p-4">
                    <h2 class="card-title h4 mb-3">Edit Teacher Profile: {{ $teacher->name }}</h2>
                    <p class="text-secondary">Update the faculty details below. Fields marked with <span>*</span> are required.</p>

                    <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name <span>*</span></label>
                                <input type="text" name="name" value="{{ old('name', $teacher->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Designation <span>*</span></label>
                                <select name="designation" class="form-select @error('designation') is-invalid @enderror" required>
                                    <option value="">Select designation...</option>
                                    <option value="Professor" {{ old('designation', $teacher->designation) == 'Professor' ? 'selected' : '' }}>Professor</option>
                                    <option value="Associate Professor" {{ old('designation', $teacher->designation) == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                    <option value="Assistant Professor" {{ old('designation', $teacher->designation) == 'Assistant Professor' ? 'selected' : '' }}>Assistant Professor</option>
                                    <option value="Lecturer" {{ old('designation', $teacher->designation) == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                                </select>
                                @error('designation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span>*</span></label>
                                <input type="email" name="email" value="{{ old('email', $teacher->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="username@teachers.gmail.com" required>
                                <small class="text-muted" style="color: #999999 !important;">Must end with @teachers.gmail.com</small>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Password <span>(leave blank to keep current)</span></label>
                                <input type="text" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Availability Status <span>*</span></label>
                                <select name="availability_status" class="form-select @error('availability_status') is-invalid @enderror" required>
                                    <option value="">Select status...</option>
                                    <option value="Available" {{ old('availability_status', $teacher->availability_status) == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="On Leave" {{ old('availability_status', $teacher->availability_status) == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                                </select>
                                @error('availability_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" name="is_head" id="is_head_edit" {{ old('is_head', $teacher->is_head) ? 'checked' : '' }}>
                                    <label class="form-check-label text-white" for="is_head_edit">
                                        Mark as Head of Department
                                    </label>
                                </div>
                                @error('is_head')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Office Room</label>
                                <input type="text" name="office_room" value="{{ old('office_room', $teacher->office_room) }}" class="form-control @error('office_room') is-invalid @enderror">
                                @error('office_room')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Website URL <span class="text-secondary">(optional)</span></label>
                                <input type="url" name="website_url" value="{{ old('website_url', $teacher->website_url) }}" class="form-control @error('website_url') is-invalid @enderror">
                                @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Profile Image URL <span class="text-secondary">(optional)</span></label>
                                <input type="url" name="profile_image" value="{{ old('profile_image', $teacher->profile_image) }}" class="form-control @error('profile_image') is-invalid @enderror" placeholder="https://">
                                @error('profile_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Short Bio <span class="text-secondary">(optional)</span></label>
                                <textarea name="short_bio" class="form-control @error('short_bio') is-invalid @enderror" rows="3">{{ old('short_bio', $teacher->short_bio) }}</textarea>
                                @error('short_bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Research Interests <span class="text-secondary">(optional, comma separated)</span></label>
                                <input type="text" name="research_interests" value="{{ old('research_interests', $teacher->research_interests) }}" class="form-control @error('research_interests') is-invalid @enderror" placeholder="AI, Data Mining, Cybersecurity">
                                @error('research_interests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Education <span class="text-secondary">(optional, one per line)</span></label>
                                <textarea name="education" class="form-control @error('education') is-invalid @enderror" placeholder="Ph.D. ...&#10;M.Sc. ...">{{ old('education', is_array($teacher->education) ? implode("\n", $teacher->education) : '') }}</textarea>
                                @error('education')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Honors & Awards <span class="text-secondary">(optional, one per line)</span></label>
                                <textarea name="honors" class="form-control @error('honors') is-invalid @enderror" placeholder="Best Paper ...">{{ old('honors', is_array($teacher->honors) ? implode("\n", $teacher->honors) : '') }}</textarea>
                                @error('honors')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Courses Taught <span class="text-secondary">(optional, one per line)</span></label>
                                <textarea name="courses" class="form-control @error('courses') is-invalid @enderror" placeholder="Computer Networks">{{ old('courses', is_array($teacher->courses) ? implode("\n", $teacher->courses) : '') }}</textarea>
                                @error('courses')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Publications Highlight <span class="text-secondary">(optional)</span></label>
                                <textarea name="publications" class="form-control @error('publications') is-invalid @enderror" rows="3" placeholder="Key publication summary...">{{ old('publications', $teacher->publications) }}</textarea>
                                @error('publications')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Update Teacher Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>