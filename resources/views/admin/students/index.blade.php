<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students | Admin</title>
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
        .badge.bg-secondary {
            background: #6b7280 !important;
        }
        .badge.bg-warning {
            background: #f59e0b !important;
            color: #000000 !important;
        }
        .badge.bg-danger {
            background: #ef4444 !important;
            color: #ffffff !important;
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
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #fca5a5;
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
        .form-check-input {
            width: 1.05em;
            height: 1.05em;
        }
        .form-check-label {
            color: #ffffff !important;
        }
        .invalid-feedback {
            color: #fca5a5 !important;
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
        @if(session('error'))
            <div class="alert alert-danger mb-4"><i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}</div>
        @endif

        <div class="alert alert-info mb-4" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); color: #93c5fd;">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-2" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Manage Students</strong><br>
                    <small>Student ID Format: BBYY### (e.g., 2107063 = Batch 2k21, Dept 07, Roll 063). Maximum 121 students per batch.</small>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Add Student Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Add New Student</h2>
                    <form method="POST" action="{{ route('admin.students.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Student Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Batch *</label>
                            <select name="batch" class="form-select @error('batch') is-invalid @enderror" required>
                                <option value="">Select Batch</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->name }}" {{ old('batch') == $batch->name ? 'selected' : '' }}>{{ $batch->name }}</option>
                                @endforeach
                            </select>
                            @error('batch')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Student ID will be auto-generated</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="studentid@stud.kuet.ac.bd" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password *</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Picture URL</label>
                            <input type="url" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" value="{{ old('profile_picture') }}" placeholder="https://example.com/image.jpg">
                            @error('profile_picture')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Enter a valid image URL (optional)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">CGPA</label>
                            <input type="number" step="0.01" min="0" max="4" name="cgpa" class="form-control @error('cgpa') is-invalid @enderror" value="{{ old('cgpa', '0.00') }}">
                            @error('cgpa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Semester</label>
                            <select name="current_semester" class="form-select @error('current_semester') is-invalid @enderror">
                                <option value="">Select Semester</option>
                                <option value="1-1" {{ old('current_semester') == '1-1' ? 'selected' : '' }}>1-1</option>
                                <option value="1-2" {{ old('current_semester') == '1-2' ? 'selected' : '' }}>1-2</option>
                                <option value="2-1" {{ old('current_semester') == '2-1' ? 'selected' : '' }}>2-1</option>
                                <option value="2-2" {{ old('current_semester') == '2-2' ? 'selected' : '' }}>2-2</option>
                                <option value="3-1" {{ old('current_semester') == '3-1' ? 'selected' : '' }}>3-1</option>
                                <option value="3-2" {{ old('current_semester') == '3-2' ? 'selected' : '' }}>3-2</option>
                                <option value="4-1" {{ old('current_semester') == '4-1' ? 'selected' : '' }}>4-1</option>
                                <option value="4-2" {{ old('current_semester') == '4-2' ? 'selected' : '' }}>4-2</option>
                            </select>
                            @error('current_semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Can login)</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Student</button>
                    </form>
                </div>
            </div>

            <!-- Students List -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Existing Students ({{ $students->total() }})</h2>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Batch</th>
                                    <th>CGPA</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td><strong>{{ $student->student_id }}</strong></td>
                                        <td>
                                            <div>{{ $student->name }}</div>
                                            <small class="text-muted">{{ $student->email }}</small>
                                        </td>
                                        <td><span class="badge bg-primary">{{ $student->batch }}</span></td>
                                        <td>{{ number_format($student->cgpa, 2) }}</td>
                                        <td>
                                            @if($student->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.students.edit', $student) }}" class="badge bg-warning text-dark">Edit</a>
                                                <form method="POST" action="{{ route('admin.students.destroy', $student) }}" class="d-inline" onsubmit="return confirm('Delete this student?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger border-0">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">No students found. Add your first student above.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
