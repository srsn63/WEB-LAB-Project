<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events | Admin</title>
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
        .badge-featured { background: #f59e0b; color: #fff; }
        .table { color: #ffffff; }
        .table thead th { color: #9fb2ff; border-bottom-color: #333333; }
        .table tbody tr { border-color: #333333; }
        ::placeholder { color: #cccccc !important; }
        .stat-card { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); border: 2px solid #334155; border-radius: 12px; padding: 1.5rem; }
        .stat-icon { font-size: 2rem; opacity: 0.8; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Manage Events</span>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('events.index') }}" class="btn btn-outline-success btn-sm" target="_blank">
                    <i class="bi bi-eye-fill"></i> View Public Page
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-house-fill"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        <!-- Statistics -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <div class="stat-icon text-primary"><i class="bi bi-calendar-check"></i></div>
                    <h3 class="h4 mt-2">{{ $upcomingCount }}</h3>
                    <p class="text-muted mb-0">Upcoming Events</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <div class="stat-icon text-secondary"><i class="bi bi-clock-history"></i></div>
                    <h3 class="h4 mt-2">{{ $pastCount }}</h3>
                    <p class="text-muted mb-0">Past Events</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <div class="stat-icon text-warning"><i class="bi bi-star-fill"></i></div>
                    <h3 class="h4 mt-2">{{ $featuredCount }}</h3>
                    <p class="text-muted mb-0">Featured Events</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Add Event Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-plus-circle"></i> Schedule New Event</h2>
                    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Event Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Annual Tech Fest 2025" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Describe the event..." required>{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Type</label>
                            <select name="event_type" class="form-select @error('event_type') is-invalid @enderror">
                                <option value="">Select Type</option>
                                <option value="Workshop" {{ old('event_type') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="Seminar" {{ old('event_type') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                <option value="Competition" {{ old('event_type') == 'Competition' ? 'selected' : '' }}>Competition</option>
                                <option value="Conference" {{ old('event_type') == 'Conference' ? 'selected' : '' }}>Conference</option>
                                <option value="Social" {{ old('event_type') == 'Social' ? 'selected' : '' }}>Social Event</option>
                                <option value="Academic" {{ old('event_type') == 'Academic' ? 'selected' : '' }}>Academic</option>
                                <option value="Cultural" {{ old('event_type') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                                <option value="Other" {{ old('event_type') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('event_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror" value="{{ old('venue') }}" placeholder="e.g. Central Auditorium">
                            @error('venue')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Event Date & Time *</label>
                                <input type="datetime-local" name="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date') }}" required>
                                @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Date & Time</label>
                                <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Organizer</label>
                            <input type="text" name="organizer" class="form-control @error('organizer') is-invalid @enderror" value="{{ old('organizer') }}" placeholder="e.g. CSE Department">
                            @error('organizer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror" value="{{ old('contact_email') }}" placeholder="contact@example.com">
                            @error('contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Registration Link (Optional)</label>
                            <input type="url" name="registration_link" class="form-control @error('registration_link') is-invalid @enderror" value="{{ old('registration_link') }}" placeholder="https://forms.google.com/...">
                            @error('registration_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Max Participants (Optional)</label>
                            <input type="number" name="max_participants" class="form-control @error('max_participants') is-invalid @enderror" value="{{ old('max_participants') }}" placeholder="e.g. 100" min="1">
                            @error('max_participants')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Banner Image (Optional)</label>
                            <input type="file" name="banner_image" class="form-control @error('banner_image') is-invalid @enderror" accept="image/*">
                            @error('banner_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Max 2MB (JPEG, JPG, PNG, GIF)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', 0) }}" min="0">
                            @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="isFeatured">Mark as Featured</label>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive">Active</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-calendar-plus"></i> Schedule Event
                        </button>
                    </form>
                </div>
            </div>

            <!-- Events List -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-calendar-event"></i> All Events ({{ $events->total() }})</h2>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $event)
                                <tr>
                                    <td>
                                        <strong>{{ $event->title }}</strong>
                                        @if($event->is_featured)
                                            <span class="badge badge-featured ms-1"><i class="bi bi-star-fill"></i> Featured</span>
                                        @endif
                                        <br>
                                        <small class="text-muted">{{ Str::limit($event->description, 50) }}</small>
                                    </td>
                                    <td>
                                        <small>{{ $event->event_date->format('M d, Y') }}</small><br>
                                        <small class="text-muted">{{ $event->event_date->format('g:i A') }}</small>
                                    </td>
                                    <td>
                                        @if($event->event_type)
                                            <span class="badge bg-info">{{ $event->event_type }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $event->status_badge_class }}">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                        @if($event->is_active)
                                            <span class="badge badge-active">Active</span>
                                        @else
                                            <span class="badge badge-inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="bi bi-calendar-x display-4 text-muted"></i>
                                        <p class="mt-2">No events found. Schedule your first event!</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
