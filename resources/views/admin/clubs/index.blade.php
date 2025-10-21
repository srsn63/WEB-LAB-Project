<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clubs | Admin</title>
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
        .btn-info { background: linear-gradient(135deg, #0ea5e9, #38bdf8); border: none; }
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
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Manage Clubs</span>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('clubs.index') }}" class="btn btn-outline-success btn-sm" target="_blank">
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
            <!-- Add Club Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-plus-circle"></i> Add New Club</h2>
                    <form method="POST" action="{{ route('admin.clubs.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Club Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Special Group Interested in Programming Contest" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Name *</label>
                            <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" value="{{ old('short_name') }}" placeholder="e.g. SGIPC" required>
                            @error('short_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Describe the club's purpose and activities..." required>{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mission</label>
                            <textarea name="mission" class="form-control @error('mission') is-invalid @enderror" rows="3" placeholder="Club's mission statement...">{{ old('mission') }}</textarea>
                            @error('mission')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Vision</label>
                            <textarea name="vision" class="form-control @error('vision') is-invalid @enderror" rows="3" placeholder="Club's vision statement...">{{ old('vision') }}</textarea>
                            @error('vision')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Max 2MB, JPG/PNG/GIF</small>
                            @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="club@example.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Facebook URL</label>
                            <input type="url" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url') }}" placeholder="https://facebook.com/clubpage">
                            @error('facebook_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Website URL</label>
                            <input type="url" name="website_url" class="form-control @error('website_url') is-invalid @enderror" value="{{ old('website_url') }}" placeholder="https://club.example.com">
                            @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Founded Date</label>
                            <input type="date" name="founded_date" class="form-control @error('founded_date') is-invalid @enderror" value="{{ old('founded_date') }}">
                            @error('founded_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                            <i class="bi bi-plus-circle"></i> Add Club
                        </button>
                    </form>
                </div>
            </div>

            <!-- List of Clubs -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-list-ul"></i> All Clubs ({{ $clubs->total() }})</h2>
                    
                    @if($clubs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Club</th>
                                        <th>Members</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clubs as $club)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($club->logo)
                                                        <img src="{{ asset('storage/' . $club->logo) }}" alt="{{ $club->name }}" 
                                                             style="width: 40px; height: 40px; border-radius: 8px; object-fit: cover; margin-right: 10px;">
                                                    @endif
                                                    <div>
                                                        <strong>{{ $club->short_name }}</strong>
                                                        <br><small class="text-muted">{{ Str::limit($club->name, 40) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $club->members_count }} Members</span>
                                            </td>
                                            <td>
                                                @if($club->is_active)
                                                    <span class="badge badge-active">Active</span>
                                                @else
                                                    <span class="badge badge-inactive">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('admin.clubs.members', $club) }}" class="btn btn-info" title="Manage Members">
                                                        <i class="bi bi-people"></i>
                                                    </a>
                                                    <a href="{{ route('admin.clubs.workshops', $club) }}" class="btn btn-success" title="Manage Workshops">
                                                        <i class="bi bi-book"></i>
                                                    </a>
                                                    <a href="{{ route('admin.clubs.events', $club) }}" class="btn btn-primary" title="Manage Events">
                                                        <i class="bi bi-calendar-event"></i>
                                                    </a>
                                                    <a href="{{ route('admin.clubs.edit', $club) }}" class="btn btn-warning" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.clubs.destroy', $club) }}" 
                                                          onsubmit="return confirm('Are you sure you want to delete this club?')" 
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="bi bi-trash"></i>
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
                            {{ $clubs->links() }}
                        </div>
                    @else
                        <p class="text-center text-muted py-4">No clubs added yet. Add your first club using the form.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
