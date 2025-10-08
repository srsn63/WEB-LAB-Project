<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher Profile | KUET CSE Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(160deg, #020617 0%, #0f172a 45%, #1e293b 100%);
            min-height: 100vh;
            color: #e2e8f0;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: rgba(15, 23, 42, 0.9) !important;
            border-bottom: 1px solid rgba(148, 163, 184, 0.25);
        }
        .card-glass {
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 24px;
            box-shadow: 0 24px 80px rgba(30, 64, 175, 0.35);
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            font-weight: 600;
        }
        .btn-outline-light {
            border-color: rgba(148, 163, 184, 0.4);
            color: #e2e8f0;
        }
        .btn-secondary {
            background: rgba(148, 163, 184, 0.2);
            border: 1px solid rgba(148, 163, 184, 0.4);
            color: #e2e8f0;
        }
        .form-control, .form-select {
            background: rgba(2, 6, 23, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.25);
            color: #f8fafc;
        }
        .form-control:focus {
            background: rgba(2, 6, 23, 0.9);
            box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.25);
            border-color: rgba(56, 189, 248, 0.6);
        }
        label {
            color: #ffffff;
        }
        label span {
            color: #38bdf8;
            font-size: 0.85rem;
        }
        textarea {
            min-height: 110px;
        }
        .alert {
            border-radius: 16px;
            border: 1px solid rgba(59, 130, 246, 0.35);
            background: rgba(56, 189, 248, 0.08);
            color: #e0f2fe;
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
                                <label class="form-label">Department <span>*</span></label>
                                <input type="text" name="department" value="{{ old('department', $teacher->department) }}" class="form-control @error('department') is-invalid @enderror" required>
                                @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $teacher->email) }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <label class="form-label">Website URL</label>
                                <input type="url" name="website_url" value="{{ old('website_url', $teacher->website_url) }}" class="form-control @error('website_url') is-invalid @enderror">
                                @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Availability Status</label>
                                <select name="availability_status" class="form-select @error('availability_status') is-invalid @enderror">
                                    <option value="">Select status...</option>
                                    <option value="Available" {{ old('availability_status', $teacher->availability_status) == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="On Leave" {{ old('availability_status', $teacher->availability_status) == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                                </select>
                                @error('availability_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Profile Image URL</label>
                                <input type="url" name="profile_image" value="{{ old('profile_image', $teacher->profile_image) }}" class="form-control @error('profile_image') is-invalid @enderror" placeholder="https://">
                                @error('profile_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Short Bio</label>
                                <textarea name="short_bio" class="form-control @error('short_bio') is-invalid @enderror" rows="3">{{ old('short_bio', $teacher->short_bio) }}</textarea>
                                @error('short_bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Research Interests <span class="text-secondary">(comma separated)</span></label>
                                <input type="text" name="research_interests" value="{{ old('research_interests', $teacher->research_interests) }}" class="form-control @error('research_interests') is-invalid @enderror" placeholder="AI, Data Mining, Cybersecurity">
                                @error('research_interests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Education <span>(one per line)</span></label>
                                <textarea name="education" class="form-control @error('education') is-invalid @enderror" placeholder="Ph.D. ...&#10;M.Sc. ...">{{ old('education', is_array($teacher->education) ? implode("\n", $teacher->education) : '') }}</textarea>
                                @error('education')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Honors & Awards <span>(one per line)</span></label>
                                <textarea name="honors" class="form-control @error('honors') is-invalid @enderror" placeholder="Best Paper ...">{{ old('honors', is_array($teacher->honors) ? implode("\n", $teacher->honors) : '') }}</textarea>
                                @error('honors')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Courses Taught <span>(one per line)</span></label>
                                <textarea name="courses" class="form-control @error('courses') is-invalid @enderror" placeholder="Computer Networks">{{ old('courses', is_array($teacher->courses) ? implode("\n", $teacher->courses) : '') }}</textarea>
                                @error('courses')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Publications Highlight</label>
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