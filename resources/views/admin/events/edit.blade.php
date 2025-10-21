<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #000000; color: #ffffff; }
        .navbar { background: #000000; border-bottom: 1px solid #333333; }
        .card { background: #000000; border: 2px solid #333333; border-radius: 12px; color: #ffffff; }
        .btn-primary { background: linear-gradient(135deg, #2563eb, #38bdf8); border: none; }
        .btn-secondary { background: linear-gradient(135deg, #6b7280, #9ca3af); border: none; }
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
        img.banner-preview { max-width: 100%; border-radius: 8px; border: 2px solid #333333; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Edit Event</span>
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left"></i> Back to Events
            </a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4">
                    <h2 class="h4 mb-4"><i class="bi bi-pencil-square"></i> Edit Event: {{ $event->title }}</h2>
                    
                    <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Event Title *</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $event->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Event Type</label>
                            <select name="event_type" class="form-select @error('event_type') is-invalid @enderror">
                                <option value="">Select Type</option>
                                <option value="Workshop" {{ old('event_type', $event->event_type) == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="Seminar" {{ old('event_type', $event->event_type) == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                <option value="Competition" {{ old('event_type', $event->event_type) == 'Competition' ? 'selected' : '' }}>Competition</option>
                                <option value="Conference" {{ old('event_type', $event->event_type) == 'Conference' ? 'selected' : '' }}>Conference</option>
                                <option value="Social" {{ old('event_type', $event->event_type) == 'Social' ? 'selected' : '' }}>Social Event</option>
                                <option value="Academic" {{ old('event_type', $event->event_type) == 'Academic' ? 'selected' : '' }}>Academic</option>
                                <option value="Cultural" {{ old('event_type', $event->event_type) == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                                <option value="Other" {{ old('event_type', $event->event_type) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('event_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror" value="{{ old('venue', $event->venue) }}">
                            @error('venue')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Event Date & Time *</label>
                                <input type="datetime-local" name="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required>
                                @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Date & Time</label>
                                <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d\TH:i') : '') }}">
                                @error('end_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Organizer</label>
                            <input type="text" name="organizer" class="form-control @error('organizer') is-invalid @enderror" value="{{ old('organizer', $event->organizer) }}">
                            @error('organizer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror" value="{{ old('contact_email', $event->contact_email) }}">
                            @error('contact_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Registration Link (Optional)</label>
                            <input type="url" name="registration_link" class="form-control @error('registration_link') is-invalid @enderror" value="{{ old('registration_link', $event->registration_link) }}">
                            @error('registration_link')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Max Participants (Optional)</label>
                            <input type="number" name="max_participants" class="form-control @error('max_participants') is-invalid @enderror" value="{{ old('max_participants', $event->max_participants) }}" min="1">
                            @error('max_participants')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Banner Image (Optional)</label>
                            @if($event->banner_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $event->banner_image) }}" alt="Current Banner" class="banner-preview">
                                    <p class="text-muted mt-2 mb-0"><small>Current banner (upload a new one to replace)</small></p>
                                </div>
                            @endif
                            <input type="file" name="banner_image" class="form-control @error('banner_image') is-invalid @enderror" accept="image/*">
                            @error('banner_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Max 2MB (JPEG, JPG, PNG, GIF)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $event->order) }}" min="0">
                            @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" value="1" {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isFeatured">Mark as Featured</label>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive">Active</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-check-circle"></i> Update Event
                            </button>
                            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
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
