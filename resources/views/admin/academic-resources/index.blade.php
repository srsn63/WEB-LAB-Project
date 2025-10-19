<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Academic Resources | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #000000; color: #ffffff; }
        .navbar { background: #000000; border-bottom: 1px solid #333333; }
        .card { background: #000000; border: 2px solid #333333; border-radius: 12px; color: #ffffff; }
        .btn-primary { background: linear-gradient(135deg, #2563eb, #38bdf8); border: none; }
        .form-control, .form-select, textarea { 
            background: #000000 !important; 
            border: 2px solid #555555 !important; 
            color: #ffffff !important; 
        }
        .form-control:focus, .form-select:focus, textarea:focus { 
            border-color: #ffffff !important; 
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }
        label { color: #ffffff; font-weight: 600; }
        .badge-cat { background: #333333; color: #ffffff; padding: 0.35rem 0.6rem; border-radius: 999px; }
        .table { color: #ffffff; }
        .table thead th { color: #9fb2ff; border-bottom-color: #333333; }
        .table tbody tr { border-color: #333333; }
        ::placeholder { color: #cccccc !important; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Academic Resources</span>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('academic-resources.index') }}" class="btn btn-outline-success btn-sm" target="_blank">
                    <i class="bi bi-eye-fill"></i> View Public Page
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-house-fill"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @if(session('status'))
            <div class="alert alert-success mb-4">{{ session('status') }}</div>
        @endif

        <!-- Info Banner -->
        <div class="alert alert-info mb-4" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); color: #93c5fd;">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-2" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Manage Academic Resources</strong><br>
                    <small>Add course materials, syllabi, and academic calendars. Students can access them from the Academic Resources page.</small>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Add Resource Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Add Academic Resource</h2>
                    <form method="POST" action="{{ route('admin.academic-resources.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Batch *</label>
                            <select name="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                                <option value="">Select Batch</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('batch_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                <option value="course_material" {{ old('category') == 'course_material' ? 'selected' : '' }}>Course Material</option>
                                <option value="syllabus" {{ old('category') == 'syllabus' ? 'selected' : '' }}>Syllabus</option>
                                <option value="academic_calendar" {{ old('category') == 'academic_calendar' ? 'selected' : '' }}>Academic Calendar</option>
                            </select>
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File URL</label>
                            <input type="url" name="file_url" class="form-control @error('file_url') is-invalid @enderror" value="{{ old('file_url') }}" placeholder="https://...">
                            @error('file_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3" id="courseCodeField">
                            <label class="form-label">Course Code</label>
                            <input type="text" name="course_code" class="form-control @error('course_code') is-invalid @enderror" value="{{ old('course_code') }}" placeholder="e.g., CSE-101">
                            @error('course_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="text" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester') }}" placeholder="e.g., Fall 2024">
                            @error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Visible to students)</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add Resource</button>
                    </form>
                </div>
            </div>

            <!-- Resources List -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Existing Resources</h2>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Batch</th>
                                    <th>Category</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($resources as $resource)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $resource->title }}</div>
                                            <small class="text-muted">{{ $resource->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $resource->batch?->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge-cat">
                                                {{ ucwords(str_replace('_', ' ', $resource->category)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($resource->course_code)
                                                <small>{{ $resource->course_code }}</small>
                                            @else
                                                <small class="text-muted">—</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($resource->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.academic-resources.edit', $resource) }}" class="badge bg-warning text-dark">Edit</a>
                                                <form method="POST" action="{{ route('admin.academic-resources.destroy', $resource) }}" class="d-inline" onsubmit="return confirm('Delete this resource?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger border-0">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No resources yet. Add one above!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $resources->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/hide Course Code field based on category selection
        const categorySelect = document.querySelector('select[name="category"]');
        const courseCodeField = document.getElementById('courseCodeField');
        
        function toggleCourseCodeField() {
            const selectedCategory = categorySelect.value;
            if (selectedCategory === 'academic_calendar') {
                courseCodeField.style.display = 'none';
                // Clear the course code input when hidden
                courseCodeField.querySelector('input').value = '';
            } else {
                courseCodeField.style.display = 'block';
            }
        }
        
        // Run on page load
        toggleCourseCodeField();
        
        // Run when category changes
        categorySelect.addEventListener('change', toggleCourseCodeField);
    </script>
</body>
</html>
