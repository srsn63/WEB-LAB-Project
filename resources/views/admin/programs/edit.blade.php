<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #000000; color: #ffffff; min-height: 100vh; }
        .navbar { background: #000000; border-bottom: 1px solid #333333; }
        .card { background: #000000; border: 2px solid #333333; border-radius: 12px; color: #ffffff; }
        .btn-primary { background: linear-gradient(135deg, #2563eb, #38bdf8); border: none; }
        .btn-secondary { background: #6b7280; border: none; }
        .form-control, .form-select, textarea { 
            background: #000000 !important; 
            border: 2px solid #555555 !important; 
            color: #ffffff !important; 
        }
        .form-control:focus, .form-select:focus, textarea:focus { 
            border-color: #ffffff !important; 
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
        }
        .form-check-input {
            background-color: #000000;
            border: 2px solid #555555;
        }
        .form-check-input:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        label { color: #ffffff; font-weight: 600; }
        ::placeholder { color: #cccccc !important; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Edit Program</span>
            <div class="ms-auto">
                <a href="{{ route('admin.programs.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4">
                    <h2 class="h3 mb-4"><i class="bi bi-pencil-square"></i> Edit Program</h2>
                    
                    <form method="POST" action="{{ route('admin.programs.update', $program) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Program Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $program->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Name *</label>
                            <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" value="{{ old('short_name', $program->short_name) }}" required>
                            @error('short_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Degree Type *</label>
                            <select name="degree_type" class="form-select @error('degree_type') is-invalid @enderror" required>
                                <option value="">Select Type</option>
                                @foreach($degreeTypes as $key => $label)
                                    <option value="{{ $key }}" {{ old('degree_type', $program->degree_type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('degree_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Duration *</label>
                                <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $program->duration) }}" required>
                                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Credits *</label>
                                <input type="number" name="total_credits" class="form-control @error('total_credits') is-invalid @enderror" value="{{ old('total_credits', $program->total_credits) }}" required>
                                @error('total_credits')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $program->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Objectives</label>
                            <textarea name="objectives" class="form-control @error('objectives') is-invalid @enderror" rows="4">{{ old('objectives', $program->objectives) }}</textarea>
                            @error('objectives')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Career Prospects</label>
                            <textarea name="career_prospects" class="form-control @error('career_prospects') is-invalid @enderror" rows="4">{{ old('career_prospects', $program->career_prospects) }}</textarea>
                            @error('career_prospects')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Admission Requirements</label>
                            <textarea name="admission_requirements" class="form-control @error('admission_requirements') is-invalid @enderror" rows="4">{{ old('admission_requirements', $program->admission_requirements) }}</textarea>
                            @error('admission_requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Program Coordinator</label>
                            <select name="program_coordinator_id" class="form-select @error('program_coordinator_id') is-invalid @enderror">
                                <option value="">Select Coordinator (Optional)</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('program_coordinator_id', $program->program_coordinator_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_coordinator_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $program->order) }}">
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', $program->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Visible to public)</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Program
                            </button>
                            <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
