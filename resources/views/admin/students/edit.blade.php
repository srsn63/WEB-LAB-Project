<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Admin</title>
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
                <a href="{{ route('admin.students.index') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Back to Students</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Edit Student</h2>
                    <form method="POST" action="{{ route('admin.students.update', $student) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Student ID</label>
                            <input type="text" class="form-control" value="{{ $student->student_id }}" disabled>
                            <small class="text-muted">Student ID cannot be changed</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Batch</label>
                            <input type="text" class="form-control" value="{{ $student->batch }}" disabled>
                            <small class="text-muted">Batch cannot be changed</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Student Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $student->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $student->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Leave blank to keep current password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $student->phone) }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Picture URL</label>
                            <input type="url" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" value="{{ old('profile_picture', $student->profile_picture) }}" placeholder="https://example.com/image.jpg">
                            @error('profile_picture')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Enter a valid image URL (optional)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">CGPA</label>
                            <input type="number" step="0.01" min="0" max="4" name="cgpa" class="form-control @error('cgpa') is-invalid @enderror" value="{{ old('cgpa', $student->cgpa) }}">
                            @error('cgpa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Semester</label>
                            <select name="current_semester" class="form-select @error('current_semester') is-invalid @enderror">
                                <option value="">Select Semester</option>
                                <option value="1-1" {{ old('current_semester', $student->current_semester) == '1-1' ? 'selected' : '' }}>1-1</option>
                                <option value="1-2" {{ old('current_semester', $student->current_semester) == '1-2' ? 'selected' : '' }}>1-2</option>
                                <option value="2-1" {{ old('current_semester', $student->current_semester) == '2-1' ? 'selected' : '' }}>2-1</option>
                                <option value="2-2" {{ old('current_semester', $student->current_semester) == '2-2' ? 'selected' : '' }}>2-2</option>
                                <option value="3-1" {{ old('current_semester', $student->current_semester) == '3-1' ? 'selected' : '' }}>3-1</option>
                                <option value="3-2" {{ old('current_semester', $student->current_semester) == '3-2' ? 'selected' : '' }}>3-2</option>
                                <option value="4-1" {{ old('current_semester', $student->current_semester) == '4-1' ? 'selected' : '' }}>4-1</option>
                                <option value="4-2" {{ old('current_semester', $student->current_semester) == '4-2' ? 'selected' : '' }}>4-2</option>
                            </select>
                            @error('current_semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $student->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Can login)</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
