<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Workshops - {{ $club->name }} | Admin</title>
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
        .badge-active { background: #22c55e; color: #fff; }
        .badge-inactive { background: #6b7280; color: #fff; }
        .badge-upcoming { background: #3b82f6; color: #fff; }
        .badge-past { background: #6b7280; color: #fff; }
        .table { color: #ffffff; }
        .table thead th { color: #9fb2ff; border-bottom-color: #333333; }
        .table tbody tr { border-color: #333333; }
        ::placeholder { color: #cccccc !important; }
        .club-header {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Manage Workshops</span>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('admin.clubs.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to Clubs
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="club-header text-center">
            <h1 class="h3">{{ $club->name }}</h1>
            <p class="mb-0">Manage Workshops</p>
        </div>

        @if(session('status'))
            <div class="alert alert-success mb-4">{{ session('status') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        <div class="row g-4">
            <!-- Add Workshop Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-plus-circle"></i> Add Workshop</h2>
                    <form method="POST" action="{{ route('admin.clubs.workshops.store', $club) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}" placeholder="e.g. Web Development Workshop" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="4" placeholder="Workshop details and objectives..." required>{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Instructor</label>
                            <input type="text" name="instructor" class="form-control @error('instructor') is-invalid @enderror" 
                                   value="{{ old('instructor') }}" placeholder="e.g. John Doe">
                            @error('instructor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror" 
                                   value="{{ old('venue') }}" placeholder="e.g. Room 101, CSE Building">
                            @error('venue')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Date & Time *</label>
                                <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" 
                                       value="{{ old('start_date') }}" required>
                                @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Date & Time</label>
                                <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" 
                                       value="{{ old('end_date') }}">
                                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Max Participants</label>
                            <input type="number" name="max_participants" class="form-control @error('max_participants') is-invalid @enderror" 
                                   value="{{ old('max_participants') }}" placeholder="e.g. 50" min="1">
                            @error('max_participants')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Registration Link</label>
                            <input type="url" name="registration_link" class="form-control @error('registration_link') is-invalid @enderror" 
                                   value="{{ old('registration_link') }}" placeholder="https://forms.google.com/...">
                            @error('registration_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Visible to public)</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Add Workshop
                        </button>
                    </form>
                </div>
            </div>

            <!-- List of Workshops -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-book"></i> Workshops ({{ $club->workshops->count() }})</h2>
                    
                    @if($club->workshops->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Workshop</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($club->workshops()->orderBy('start_date', 'desc')->get() as $workshop)
                                        <tr>
                                            <td>
                                                <strong>{{ $workshop->title }}</strong>
                                                @if($workshop->instructor)
                                                    <br><small class="text-muted"><i class="bi bi-person"></i> {{ $workshop->instructor }}</small>
                                                @endif
                                                @if($workshop->venue)
                                                    <br><small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $workshop->venue }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <small>{{ \Carbon\Carbon::parse($workshop->start_date)->format('M d, Y h:i A') }}</small>
                                                @if($workshop->end_date)
                                                    <br><small class="text-muted">to {{ \Carbon\Carbon::parse($workshop->end_date)->format('h:i A') }}</small>
                                                @endif
                                                <br>
                                                @if(\Carbon\Carbon::parse($workshop->start_date)->isFuture())
                                                    <span class="badge badge-upcoming">Upcoming</span>
                                                @else
                                                    <span class="badge badge-past">Past</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($workshop->is_active)
                                                    <span class="badge badge-active">Active</span>
                                                @else
                                                    <span class="badge badge-inactive">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-warning" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editModal{{ $workshop->id }}" 
                                                            title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.clubs.workshops.destroy', [$club, $workshop]) }}" 
                                                          onsubmit="return confirm('Delete this workshop?')" 
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal{{ $workshop->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content" style="background: #1a1a1a; border: 2px solid #333;">
                                                            <div class="modal-header" style="border-bottom-color: #333;">
                                                                <h5 class="modal-title">Edit Workshop</h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('admin.clubs.workshops.update', [$club, $workshop]) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Title *</label>
                                                                        <input type="text" name="title" class="form-control" value="{{ $workshop->title }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Description *</label>
                                                                        <textarea name="description" class="form-control" rows="3" required>{{ $workshop->description }}</textarea>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label class="form-label">Instructor</label>
                                                                            <input type="text" name="instructor" class="form-control" value="{{ $workshop->instructor }}">
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label class="form-label">Venue</label>
                                                                            <input type="text" name="venue" class="form-control" value="{{ $workshop->venue }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label class="form-label">Start Date & Time *</label>
                                                                            <input type="datetime-local" name="start_date" class="form-control" 
                                                                                   value="{{ \Carbon\Carbon::parse($workshop->start_date)->format('Y-m-d\TH:i') }}" required>
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label class="form-label">End Date & Time</label>
                                                                            <input type="datetime-local" name="end_date" class="form-control" 
                                                                                   value="{{ $workshop->end_date ? \Carbon\Carbon::parse($workshop->end_date)->format('Y-m-d\TH:i') : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Max Participants</label>
                                                                        <input type="number" name="max_participants" class="form-control" value="{{ $workshop->max_participants }}" min="1">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Registration Link</label>
                                                                        <input type="url" name="registration_link" class="form-control" value="{{ $workshop->registration_link }}">
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="is_active" class="form-check-input" 
                                                                               id="edit_is_active{{ $workshop->id }}" value="1" 
                                                                               {{ $workshop->is_active ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="edit_is_active{{ $workshop->id }}">Active (Visible to public)</label>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer" style="border-top-color: #333;">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Update Workshop</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted py-4">No workshops yet. Add your first workshop using the form.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
