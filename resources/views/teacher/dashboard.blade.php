<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard | KUET CSE</title>
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
        .btn-primary:hover {
            filter: brightness(1.05);
        }
        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .form-control, .form-select, textarea {
            background: #000000 !important;
            border: 2px solid #555555 !important;
            color: #ffffff !important;
            padding: 0.75rem;
        }
        .form-control:focus, textarea:focus {
            background: #000000 !important;
            border-color: #ffffff !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }
        ::placeholder {
            color: #cccccc !important;
        }
        label {
            color: #ffffff !important;
            font-weight: 600;
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid #22c55e;
            color: #86efac;
        }
        .alert-danger {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid #ef4444;
            color: #fca5a5;
        }
        .form-section {
            padding: 1.25rem;
        }
        .badge {
            padding: 0.4rem 0.8rem;
        }
        textarea {
            min-height: 100px;
        }
        .info-label {
            color: #999999 !important;
            font-weight: 500;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand fw-semibold">KUET CSE - Teacher Portal</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-light">Welcome, {{ $teacher->name }}!</span>
            <form method="POST" action="{{ route('teacher.logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm" type="submit">Sign out</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Profile Information Card -->
        <div class="col-lg-4">
            <div class="card card-glass h-100">
                <div class="card-body">
                    <div class="form-section">
                        <h2 class="h4 mb-4">Your Information</h2>
                        <div class="mb-3">
                            <strong class="info-label">Name:</strong><br>
                            <span>{{ $teacher->name }}</span>
                        </div>
                        <div class="mb-3">
                            <strong class="info-label">Email:</strong><br>
                            <span>{{ $teacher->email }}</span>
                        </div>
                        <div class="mb-3">
                            <strong class="info-label">Designation:</strong><br>
                            <span class="badge bg-primary">{{ $teacher->designation }}</span>
                        </div>
                        <div class="mb-3">
                            <strong class="info-label">Department:</strong><br>
                            <span>Department of Computer Science & Engineering</span>
                        </div>
                        <div class="mb-3">
                            <strong class="info-label">Status:</strong><br>
                            <span class="badge {{ $teacher->availability_status === 'Available' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $teacher->availability_status }}
                            </span>
                        </div>
                        @if($teacher->is_head)
                            <div class="mb-3">
                                <span class="badge bg-info">Head of Department</span>
                            </div>
                        @endif
                        <hr style="border-color: #555555;">
                        <p class="text-muted mb-0" style="font-size: 0.85rem; color: #999999 !important;">
                            <strong>Note:</strong> Designation, Availability Status, and Head status can only be changed by the admin.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="card card-glass mt-4">
                <div class="card-body">
                    <div class="form-section">
                        <h2 class="h4 mb-4">Change Password</h2>
                        <form method="POST" action="{{ route('teacher.password.change') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" required>
                                <small class="text-muted" style="color: #999999 !important;">Minimum 6 characters</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Update Form -->
        <div class="col-lg-8">
            <div class="card card-glass">
                <div class="card-body">
                    <div class="form-section">
                        <h2 class="h4 mb-4">Update Profile Information</h2>
                        <p class="text-muted mb-4" style="color: #999999 !important;">You can update your personal information, contact details, and academic profile.</p>
                        
                        <form method="POST" action="{{ route('teacher.profile.update') }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $teacher->name) }}" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', $teacher->email) }}" class="form-control" placeholder="username@teachers.gmail.com" required>
                                    <small class="text-muted" style="color: #999999 !important;">Must end with @teachers.gmail.com</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}" class="form-control" placeholder="+880 XXX XXXX XXX">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Office Room</label>
                                    <input type="text" name="office_room" value="{{ old('office_room', $teacher->office_room) }}" class="form-control" placeholder="Room number">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Website URL</label>
                                    <input type="url" name="website_url" value="{{ old('website_url', $teacher->website_url) }}" class="form-control" placeholder="https://example.com">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Profile Image URL</label>
                                    <input type="url" name="profile_image" value="{{ old('profile_image', $teacher->profile_image) }}" class="form-control" placeholder="https://example.com/image.jpg">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Short Bio</label>
                                    <textarea name="short_bio" class="form-control" rows="3" placeholder="Brief introduction about yourself">{{ old('short_bio', $teacher->short_bio) }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Research Interests</label>
                                    <input type="text" name="research_interests" value="{{ old('research_interests', $teacher->research_interests) }}" class="form-control" placeholder="Comma separated (e.g., AI, Machine Learning, Computer Vision)">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Education</label>
                                    <textarea name="education" class="form-control" rows="4" placeholder="One per line&#10;PhD in Computer Science, University Name, Year&#10;MSc in Computer Science, University Name, Year">{{ old('education', is_array($teacher->education) ? implode("\n", $teacher->education) : '') }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Honors & Awards</label>
                                    <textarea name="honors" class="form-control" rows="4" placeholder="One per line&#10;Best Paper Award, Conference Name, Year&#10;Research Grant, Organization Name, Year">{{ old('honors', is_array($teacher->honors) ? implode("\n", $teacher->honors) : '') }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Courses Taught</label>
                                    <textarea name="courses" class="form-control" rows="4" placeholder="One per line&#10;CSE 101: Introduction to Programming&#10;CSE 201: Data Structures">{{ old('courses', is_array($teacher->courses) ? implode("\n", $teacher->courses) : '') }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Publications Highlight</label>
                                    <textarea name="publications" class="form-control" rows="5" placeholder="Enter your key publications, research papers, or scholarly work">{{ old('publications', $teacher->publications) }}</textarea>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100 mt-2">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
