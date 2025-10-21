<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Club - {{ $club->name }} | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #000000; color: #ffffff; }
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
        .current-logo {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #555555;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Edit Club</span>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('admin.clubs.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to Clubs
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

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4">
                    <h2 class="h4 mb-4"><i class="bi bi-pencil-square"></i> Edit Club: {{ $club->name }}</h2>
                    
                    <form method="POST" action="{{ route('admin.clubs.update', $club) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Club Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $club->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Short Name *</label>
                            <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" 
                                   value="{{ old('short_name', $club->short_name) }}" required>
                            @error('short_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="4" required>{{ old('description', $club->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mission</label>
                            <textarea name="mission" class="form-control @error('mission') is-invalid @enderror" 
                                      rows="3">{{ old('mission', $club->mission) }}</textarea>
                            @error('mission')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Vision</label>
                            <textarea name="vision" class="form-control @error('vision') is-invalid @enderror" 
                                      rows="3">{{ old('vision', $club->vision) }}</textarea>
                            @error('vision')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            @if($club->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $club->logo) }}" alt="Current Logo" class="current-logo">
                                    <p class="text-muted small mt-1">Current logo</p>
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Leave empty to keep current logo. Max 2MB, JPG/PNG/GIF</small>
                            @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $club->email) }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Facebook URL</label>
                            <input type="url" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" 
                                   value="{{ old('facebook_url', $club->facebook_url) }}">
                            @error('facebook_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Website URL</label>
                            <input type="url" name="website_url" class="form-control @error('website_url') is-invalid @enderror" 
                                   value="{{ old('website_url', $club->website_url) }}">
                            @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Founded Date</label>
                            <input type="date" name="founded_date" class="form-control @error('founded_date') is-invalid @enderror" 
                                   value="{{ old('founded_date', $club->founded_date ? $club->founded_date->format('Y-m-d') : '') }}">
                            @error('founded_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror" 
                                   value="{{ old('order', $club->order) }}">
                            <small class="text-muted">Lower numbers appear first</small>
                            @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" 
                                   {{ old('is_active', $club->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active (Visible to public)</label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-check-circle"></i> Update Club
                            </button>
                            <a href="{{ route('admin.clubs.index') }}" class="btn btn-secondary">
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
