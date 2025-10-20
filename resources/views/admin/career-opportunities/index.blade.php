<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Career Opportunities | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #000000; color: #ffffff; }
        .navbar { background: #000000; border-bottom: 1px solid #333333; }
        .card { background: #000000; border: 2px solid #333333; border-radius: 12px; color: #ffffff; }
        .btn-primary { background: linear-gradient(135deg, #2563eb, #38bdf8); border: none; }
        .btn-warning { background: linear-gradient(135deg, #f59e0b, #fbbf24); border: none; color: #000; }
        .btn-danger { background: linear-gradient(135deg, #dc2626, #ef4444); border: none; }
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
        .badge-internship { background: #10b981; color: #fff; }
        .badge-fulltime { background: #3b82f6; color: #fff; }
        .badge-parttime { background: #f59e0b; color: #fff; }
        .badge-active { background: #22c55e; color: #fff; }
        .badge-inactive { background: #6b7280; color: #fff; }
        .table { color: #ffffff; }
        .table thead th { color: #9fb2ff; border-bottom-color: #333333; }
        .table tbody tr { border-color: #333333; }
        ::placeholder { color: #cccccc !important; }
        .job-card { transition: all 0.3s; }
        .job-card:hover { border-color: #60a5fa; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Career Opportunities</span>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('career-opportunities.index') }}" class="btn btn-outline-success btn-sm" target="_blank">
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

        <div class="row g-4">
            <!-- Add Opportunity Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-plus-circle"></i> Add Career Opportunity</h2>
                    <form method="POST" action="{{ route('admin.career-opportunities.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Job Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Software Engineer Intern" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company Name *</label>
                            <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" placeholder="e.g. Google LLC" required>
                            @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Job Type *</label>
                            <select name="job_type" class="form-select @error('job_type') is-invalid @enderror" required>
                                <option value="">Select Job Type</option>
                                @foreach($jobTypes as $key => $label)
                                    <option value="{{ $key }}" {{ old('job_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('job_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Job description and responsibilities..." required>{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Requirements</label>
                            <textarea name="requirements" class="form-control @error('requirements') is-invalid @enderror" rows="3" placeholder="Required qualifications and skills...">{{ old('requirements') }}</textarea>
                            @error('requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="e.g. Dhaka, Bangladesh / Remote">
                            @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Salary Range</label>
                            <input type="text" name="salary_range" class="form-control @error('salary_range') is-invalid @enderror" value="{{ old('salary_range') }}" placeholder="e.g. 50k-70k BDT or Competitive">
                            @error('salary_range')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Application Deadline</label>
                            <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}">
                            @error('deadline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Application Link</label>
                            <input type="url" name="application_link" class="form-control @error('application_link') is-invalid @enderror" value="{{ old('application_link') }}" placeholder="https://company.com/careers/apply">
                            @error('application_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror" value="{{ old('contact_email') }}" placeholder="hr@company.com">
                            @error('contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Visible to public)</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Add Opportunity
                        </button>
                    </form>
                </div>
            </div>

            <!-- List of Opportunities -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-briefcase-fill"></i> All Career Opportunities ({{ $opportunities->total() }})</h2>
                    
                    @if($opportunities->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($opportunities as $opportunity)
                                        <tr>
                                            <td>
                                                <strong>{{ $opportunity->title }}</strong>
                                                @if($opportunity->location)
                                                    <br><small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $opportunity->location }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $opportunity->company_name }}</td>
                                            <td>
                                                @if($opportunity->job_type == 'internship')
                                                    <span class="badge badge-internship">Internship</span>
                                                @elseif($opportunity->job_type == 'full-time')
                                                    <span class="badge badge-fulltime">Full-Time</span>
                                                @elseif($opportunity->job_type == 'part-time')
                                                    <span class="badge badge-parttime">Part-Time</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($opportunity->deadline)
                                                    {{ \Carbon\Carbon::parse($opportunity->deadline)->format('M d, Y') }}
                                                    @if(\Carbon\Carbon::parse($opportunity->deadline)->isPast())
                                                        <br><small class="text-danger">Expired</small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">No deadline</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($opportunity->is_active)
                                                    <span class="badge badge-active"><i class="bi bi-check-circle"></i> Active</span>
                                                @else
                                                    <span class="badge badge-inactive"><i class="bi bi-x-circle"></i> Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.career-opportunities.edit', $opportunity) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.career-opportunities.destroy', $opportunity) }}" onsubmit="return confirm('Delete this opportunity?')" class="d-inline">
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
                            {{ $opportunities->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-briefcase" style="font-size: 3rem; color: #555;"></i>
                            <p class="mt-3 text-muted">No career opportunities added yet. Add one using the form on the left.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
