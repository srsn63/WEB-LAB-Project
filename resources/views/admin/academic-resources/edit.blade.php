<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Academic Resource | Admin</title>
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
        ::placeholder { color: #cccccc !important; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">Edit Academic Resource</span>
            <div class="ms-auto">
                <a href="{{ route('admin.academic-resources.index') }}" class="btn btn-outline-light btn-sm">Back to Resources</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Edit Resource</h2>
                    <form method="POST" action="{{ route('admin.academic-resources.update', $resource) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Batch *</label>
                            <select name="batch_id" class="form-select @error('batch_id') is-invalid @enderror" required>
                                <option value="">Select Batch</option>
                                @foreach($batches as $batch)
                                    <option value="{{ $batch->id }}" {{ old('batch_id', $resource->batch_id) == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('batch_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $resource->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category *</label>
                            <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required onchange="toggleCategoryFields()">
                                <option value="">Select Category</option>
                                <option value="course_material" {{ old('category', $resource->category) == 'course_material' ? 'selected' : '' }}>Course Material</option>
                                <option value="syllabus" {{ old('category', $resource->category) == 'syllabus' ? 'selected' : '' }}>Syllabus</option>
                                <option value="academic_calendar" {{ old('category', $resource->category) == 'academic_calendar' ? 'selected' : '' }}>Academic Calendar</option>
                                <option value="class_routine" {{ old('category', $resource->category) == 'class_routine' ? 'selected' : '' }}>Class Routine</option>
                            </select>
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $resource->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File URL</label>
                            <input type="url" name="file_url" id="file_url" class="form-control @error('file_url') is-invalid @enderror" value="{{ old('file_url', $resource->file_url) }}" placeholder="https://...">
                            @error('file_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3" id="courseCodeField">
                            <label class="form-label">Course Code</label>
                            <input type="text" name="course_code" class="form-control @error('course_code') is-invalid @enderror" value="{{ old('course_code', $resource->course_code) }}" placeholder="e.g., CSE-101">
                            @error('course_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <select name="semester" class="form-select @error('semester') is-invalid @enderror">
                                <option value="">Select Semester (Optional)</option>
                                <option value="1-1" {{ old('semester', $resource->semester) == '1-1' ? 'selected' : '' }}>1-1</option>
                                <option value="1-2" {{ old('semester', $resource->semester) == '1-2' ? 'selected' : '' }}>1-2</option>
                                <option value="2-1" {{ old('semester', $resource->semester) == '2-1' ? 'selected' : '' }}>2-1</option>
                                <option value="2-2" {{ old('semester', $resource->semester) == '2-2' ? 'selected' : '' }}>2-2</option>
                                <option value="3-1" {{ old('semester', $resource->semester) == '3-1' ? 'selected' : '' }}>3-1</option>
                                <option value="3-2" {{ old('semester', $resource->semester) == '3-2' ? 'selected' : '' }}>3-2</option>
                                <option value="4-1" {{ old('semester', $resource->semester) == '4-1' ? 'selected' : '' }}>4-1</option>
                                <option value="4-2" {{ old('semester', $resource->semester) == '4-2' ? 'selected' : '' }}>4-2</option>
                            </select>
                            @error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $resource->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Visible to students)</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Resource</button>
                            <a href="{{ route('admin.academic-resources.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/hide fields based on category selection
        const categorySelect = document.querySelector('select[name="category"]');
        const courseCodeField = document.getElementById('courseCodeField');
        
        function toggleCategoryFields() {
            const selectedCategory = categorySelect.value;
            
            // Handle course code field - hide for academic_calendar and class_routine
            if (selectedCategory === 'academic_calendar' || selectedCategory === 'class_routine') {
                courseCodeField.style.display = 'none';
                courseCodeField.querySelector('input').value = '';
            } else {
                courseCodeField.style.display = 'block';
            }
        }
        
        // Run on page load
        toggleCategoryFields();
        
        // Run when category changes
        categorySelect.addEventListener('change', toggleCategoryFields);
    </script>
</body>
</html>
