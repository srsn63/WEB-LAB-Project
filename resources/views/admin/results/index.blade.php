<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Results | Admin</title>
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
        .badge.grade-a-plus { background: #10b981 !important; }
        .badge.grade-a { background: #22c55e !important; }
        .badge.grade-a-minus { background: #84cc16 !important; }
        .badge.grade-b { background: #eab308 !important; color: #000 !important; }
        .badge.grade-c { background: #f97316 !important; }
        .badge.grade-d { background: #ef4444 !important; }
        .badge.grade-f { background: #dc2626 !important; }
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

    <div class="container-fluid py-4">
        @if(session('status'))
            <div class="alert alert-success mb-4"><i class="bi bi-check-circle me-2"></i>{{ session('status') }}</div>
        @endif

        <div class="alert alert-info mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-2" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Manage Student Results</strong><br>
                    <small>Select semester and student to add/view results. Grades are auto-calculated based on marks.</small>
                </div>
            </div>
        </div>

        <!-- Semester Tabs -->
        <div class="semester-tabs">
            @foreach($semesters as $sem)
                <a href="{{ route('admin.results.index', ['semester' => $sem, 'student_id' => $studentId]) }}" 
                   class="semester-tab {{ $semester == $sem ? 'active' : '' }}">
                    Semester {{ $sem }}
                </a>
            @endforeach
        </div>

        <div class="row g-4">
            <!-- Add Result Form -->
            <div class="col-lg-4">
                <div class="card p-4">
                    <h2 class="h5 mb-3">Add Result</h2>
                    <form method="POST" action="{{ route('admin.results.store') }}">
                        @csrf
                        <input type="hidden" name="semester" value="{{ $semester }}">

                        <div class="mb-3">
                            <label class="form-label">Student *</label>
                            <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                <option value="">Select Student</option>
                                @foreach($students as $stud)
                                    <option value="{{ $stud->student_id }}" {{ old('student_id') == $stud->student_id ? 'selected' : '' }}>
                                        {{ $stud->student_id }} - {{ $stud->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Course *</label>
                            <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->course_code }} - {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Exam Type *</label>
                            <select name="exam_type" class="form-select @error('exam_type') is-invalid @enderror" required>
                                <option value="final" {{ old('exam_type') == 'final' ? 'selected' : '' }}>Final</option>
                                <option value="quiz" {{ old('exam_type') == 'quiz' ? 'selected' : '' }}>Quiz</option>
                                <option value="assignment" {{ old('exam_type') == 'assignment' ? 'selected' : '' }}>Assignment</option>
                                <option value="project" {{ old('exam_type') == 'project' ? 'selected' : '' }}>Project</option>
                            </select>
                            @error('exam_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Marks Obtained *</label>
                                <input type="number" step="0.01" name="marks_obtained" class="form-control @error('marks_obtained') is-invalid @enderror" value="{{ old('marks_obtained') }}" required>
                                @error('marks_obtained')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Total Marks *</label>
                                <input type="number" step="0.01" name="total_marks" class="form-control @error('total_marks') is-invalid @enderror" value="{{ old('total_marks', 100) }}" required>
                                @error('total_marks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" rows="2" class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks') }}</textarea>
                            @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Result</button>
                    </form>
                </div>
            </div>

            <!-- Results List -->
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h5 mb-0">Results - Semester {{ $semester }}</h2>
                        <span class="badge bg-info">{{ $results->count() }} Result(s)</span>
                    </div>

                    <!-- Filter by Student -->
                    <form method="GET" class="mb-3">
                        <input type="hidden" name="semester" value="{{ $semester }}">
                        <div class="row g-2">
                            <div class="col-md-10">
                                <select name="student_id" class="form-select">
                                    <option value="">All Students</option>
                                    @foreach($students as $stud)
                                        <option value="{{ $stud->student_id }}" {{ $studentId == $stud->student_id ? 'selected' : '' }}>
                                            {{ $stud->student_id }} - {{ $stud->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </div>
                    </form>

                    @if($results->isEmpty())
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                            <p class="mt-3">No results added yet.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Exam Type</th>
                                        <th>Marks</th>
                                        <th>Grade</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results as $result)
                                        <tr>
                                            <td>
                                                <strong>{{ $result->student->student_id }}</strong><br>
                                                <small class="text-muted">{{ $result->student->name }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $result->course->course_code }}</strong><br>
                                                <small class="text-muted">{{ Str::limit($result->course->course_name, 30) }}</small>
                                            </td>
                                            <td><span class="badge bg-secondary">{{ ucfirst($result->exam_type) }}</span></td>
                                            <td>{{ $result->marks_obtained }}/{{ $result->total_marks }} ({{ round(($result->marks_obtained/$result->total_marks)*100, 2) }}%)</td>
                                            <td>
                                                <span class="badge grade-{{ strtolower(str_replace('+', '-plus', str_replace('-', '-minus', $result->grade))) }}">
                                                    {{ $result->grade }} ({{ $result->grade_point }})
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.results.edit', $result) }}" class="btn btn-sm btn-outline-light me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.results.destroy', $result) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this result?')">
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
