<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Programs | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #000000; color: #ffffff; }
        .navbar { background: #000000; border-bottom: 1px solid #333333; }
        .card { background: #000000; border: 2px solid #333333; border-radius: 12px; color: #ffffff; }
        .btn-primary { background: linear-gradient(135deg, #2563eb, #38bdf8); border: none; }
        .btn-warning { background: linear-gradient(135deg, #f59e0b, #fbbf24); border: none; color: #000; }
        .btn-danger { background: linear-gradient(135deg, #dc2626, #ef4444); border: none; }
        .btn-success { background: linear-gradient(135deg, #10b981, #34d399); border: none; }
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
        .badge { padding: 0.35rem 0.6rem; border-radius: 999px; }
        .badge-undergraduate { background: #3b82f6; color: #fff; }
        .badge-postgraduate { background: #8b5cf6; color: #fff; }
        .badge-active { background: #22c55e; color: #fff; }
        .badge-inactive { background: #6b7280; color: #fff; }
        .table { color: #ffffff; }
        .table thead th { color: #9fb2ff; border-bottom-color: #333333; }
        .table tbody tr { border-color: #333333; }
        ::placeholder { color: #cccccc !important; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Manage Programs</span>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('programs.index') }}" class="btn btn-outline-success btn-sm" target="_blank">
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
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        <div class="row g-4">
            <!-- Add Program Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-plus-circle"></i> Add New Program</h2>
                    <form method="POST" action="{{ route('admin.programs.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Program Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Bachelor of Science in Computer Science and Engineering" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Name *</label>
                            <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" value="{{ old('short_name') }}" placeholder="e.g. B.Sc. CSE" required>
                            @error('short_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Degree Type *</label>
                            <select name="degree_type" class="form-select @error('degree_type') is-invalid @enderror" required>
                                <option value="">Select Type</option>
                                @foreach($degreeTypes as $key => $label)
                                    <option value="{{ $key }}" {{ old('degree_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('degree_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Duration *</label>
                                <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" placeholder="e.g. 4 Years" required>
                                @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Credits *</label>
                                <input type="number" name="total_credits" class="form-control @error('total_credits') is-invalid @enderror" value="{{ old('total_credits') }}" placeholder="e.g. 160" required>
                                @error('total_credits')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Program overview and description..." required>{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Objectives</label>
                            <textarea name="objectives" class="form-control @error('objectives') is-invalid @enderror" rows="3" placeholder="Program learning objectives...">{{ old('objectives') }}</textarea>
                            @error('objectives')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Career Prospects</label>
                            <textarea name="career_prospects" class="form-control @error('career_prospects') is-invalid @enderror" rows="3" placeholder="Career opportunities after graduation...">{{ old('career_prospects') }}</textarea>
                            @error('career_prospects')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Admission Requirements</label>
                            <textarea name="admission_requirements" class="form-control @error('admission_requirements') is-invalid @enderror" rows="3" placeholder="Eligibility and admission criteria...">{{ old('admission_requirements') }}</textarea>
                            @error('admission_requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Program Coordinator</label>
                            <select name="program_coordinator_id" class="form-select @error('program_coordinator_id') is-invalid @enderror">
                                <option value="">Select Coordinator (Optional)</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('program_coordinator_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_coordinator_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" placeholder="0">
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Visible to public)</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Add Program
                        </button>
                    </form>
                </div>
            </div>

            <!-- List of Programs -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-list-ul"></i> All Programs ({{ $programs->total() }})</h2>
                    
                    @if($programs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Program</th>
                                        <th>Type</th>
                                        <th>Duration</th>
                                        <th>Credits</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programs as $program)
                                        <tr>
                                            <td>
                                                <strong>{{ $program->short_name }}</strong>
                                                <br><small class="text-muted">{{ Str::limit($program->name, 40) }}</small>
                                                @if($program->coordinator)
                                                    <br><small class="text-info"><i class="bi bi-person"></i> {{ $program->coordinator->name }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($program->degree_type == 'undergraduate')
                                                    <span class="badge badge-undergraduate">Undergraduate</span>
                                                @else
                                                    <span class="badge badge-postgraduate">Postgraduate</span>
                                                @endif
                                            </td>
                                            <td>{{ $program->duration }}</td>
                                            <td>{{ $program->total_credits }}</td>
                                            <td>
                                                @if($program->is_active)
                                                    <span class="badge badge-active"><i class="bi bi-check-circle"></i> Active</span>
                                                @else
                                                    <span class="badge badge-inactive"><i class="bi bi-x-circle"></i> Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1 flex-wrap">
                                                    <a href="{{ route('admin.programs.courses', $program) }}" class="btn btn-success btn-sm" title="Manage Courses">
                                                        <i class="bi bi-book"></i>
                                                    </a>
                                                    <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" onsubmit="return confirm('Delete this program and all associated data?')" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $programs->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-mortarboard" style="font-size: 3rem; color: #555;"></i>
                            <p class="mt-3 text-muted">No programs added yet. Add one using the form on the left.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
