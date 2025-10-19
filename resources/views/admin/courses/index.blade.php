<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
        .navbar-brand {
            font-weight: 700;
            color: #ffffff !important;
        }
        .card {
            background: #000000 !important;
            border: 2px solid #333333;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
        }
        .form-control, .form-select, textarea {
            background: #000000 !important;
            border: 2px solid #555555 !important;
            color: #ffffff !important;
            font-size: 1rem;
            padding: 0.75rem;
        }
        .form-control:focus, .form-select:focus, textarea:focus {
            background: #000000 !important;
            border-color: #ffffff !important;
            color: #ffffff !important;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }
        .form-control, .form-select, textarea {
            caret-color: #ffffff !important;
        }
        ::placeholder {
            color: #cccccc !important;
            opacity: 1 !important;
        }
        .form-label {
            color: #ffffff !important;
            font-weight: 600;
            font-size: 1rem;
        }
        .btn-back {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid #555555;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            border-color: #ffffff;
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            font-weight: 600;
        }
        .btn-primary:hover {
            filter: brightness(1.05);
            box-shadow: 0 6px 18px rgba(56, 189, 248, 0.15);
        }
        .table {
            color: #ffffff !important;
        }
        .table thead {
            border-bottom: 2px solid #555555;
        }
        .table tbody tr {
            border-bottom: 1px solid #333333;
        }
        .badge {
            padding: 0.35rem 0.65rem;
            font-weight: 600;
        }
        .badge.bg-primary {
            background: linear-gradient(135deg, #2563eb, #38bdf8) !important;
        }
        .badge.bg-success {
            background: #10b981 !important;
        }
        .badge.bg-info {
            background: #06b6d4 !important;
        }
        .alert {
            border-radius: 8px;
            border: 2px solid;
        }
        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
            color: #6ee7b7;
        }
        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
            color: #93c5fd;
        }
        .text-muted {
            color: #9ca3af !important;
        }
        small.text-muted {
            color: #9ca3af !important;
        }
        .invalid-feedback {
            color: #fca5a5 !important;
        }
        .semester-tabs {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }
        .semester-tab {
            padding: 0.5rem 1rem;
            border: 2px solid #555555;
            border-radius: 8px;
            background: #000000;
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .semester-tab:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-color: #ffffff;
        }
        .semester-tab.active {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border-color: #2563eb;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}"><i class="bi bi-shield-check"></i> Admin Panel</a>
            <div class="ms-auto">
                <a href="{{ route('admin.dashboard') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @if(session('status'))
            <div class="alert alert-success mb-4"><i class="bi bi-check-circle me-2"></i>{{ session('status') }}</div>
        @endif

        <div class="alert alert-info mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-2" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Manage Courses</strong><br>
                    <small>Select a semester to view and manage its courses. Add courses for each semester that students will take.</small>
                </div>
            </div>
        </div>

        <!-- Semester Tabs -->
        <div class="semester-tabs">
            @foreach($semesters as $sem)
                <a href="{{ route('admin.courses.index', ['semester' => $sem]) }}" 
                   class="semester-tab {{ $semester == $sem ? 'active' : '' }}">
                    Semester {{ $sem }}
                </a>
            @endforeach
        </div>

        <div class="row g-4">
            <!-- Add Course Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Add New Course</h2>
                    <form method="POST" action="{{ route('admin.courses.store') }}">
                        @csrf
                        <input type="hidden" name="semester" value="{{ $semester }}">

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="text" class="form-control" value="Semester {{ $semester }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Course Code *</label>
                            <input type="text" name="course_code" class="form-control @error('course_code') is-invalid @enderror" value="{{ old('course_code') }}" placeholder="e.g., CSE 101" required>
                            @error('course_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Course Name *</label>
                            <input type="text" name="course_name" class="form-control @error('course_name') is-invalid @enderror" value="{{ old('course_name') }}" placeholder="e.g., Introduction to Programming" required>
                            @error('course_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Credits *</label>
                            <input type="number" step="0.5" min="0" max="10" name="credits" class="form-control @error('credits') is-invalid @enderror" value="{{ old('credits', '3.0') }}" required>
                            @error('credits')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Brief course description">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Course</button>
                    </form>
                </div>
            </div>

            <!-- Courses List -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">Courses - Semester {{ $semester }}</h2>
                        <span class="badge bg-info">{{ $courses->count() }} Course(s)</span>
                    </div>

                    @if($courses->isEmpty())
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                            <p class="mt-3">No courses added for this semester yet.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Credits</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                        <tr>
                                            <td><strong>{{ $course->course_code }}</strong></td>
                                            <td>
                                                {{ $course->course_name }}
                                                @if($course->description)
                                                    <br><small class="text-muted">{{ Str::limit($course->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-success">{{ $course->credits }}</span></td>
                                            <td>
                                                <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline-light me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this course?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
