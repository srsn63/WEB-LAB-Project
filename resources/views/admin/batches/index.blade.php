<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Batches | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            background: #000; 
            color: #e2e8f0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        }
        .navbar {
            background: rgba(20, 20, 20, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 700;
            color: #60a5fa !important;
        }
        .card {
            background: rgba(30, 30, 30, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
        }
        .form-control, .form-select {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #e2e8f0;
        }
        .form-control:focus, .form-select:focus {
            background: rgba(30, 30, 30, 0.9);
            border-color: #60a5fa;
            color: #e2e8f0;
            box-shadow: 0 0 0 0.25rem rgba(96, 165, 250, 0.25);
        }
        .form-label {
            color: #cbd5e1;
            font-weight: 500;
        }
        .btn-back {
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.3);
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: rgba(59, 130, 246, 0.3);
            color: #bfdbfe;
        }
        .table {
            color: #e2e8f0;
        }
        .table thead {
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }
        .batch-item {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }
        .batch-item:hover {
            background: rgba(30, 41, 59, 0.7);
            border-color: rgba(96, 165, 250, 0.4);
        }
        .batch-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #60a5fa;
        }
        .resource-count {
            font-size: 0.9rem;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-shield-check"></i> Admin Panel
            </a>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('admin.dashboard') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @if(session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="alert alert-info mb-4" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); color: #93c5fd;">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-2" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Manage Batches</strong><br>
                    <small>Add or remove batches for organizing academic resources. Batch names must follow the format "2kXX" (e.g., 2k21, 2k22). Batches are automatically sorted.</small>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Add Batch Form -->
            <div class="col-lg-4">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Add New Batch</h2>
                    <form method="POST" action="{{ route('admin.batches.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Batch Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   placeholder="e.g., 2k25" 
                                   pattern="2k\d{2}" 
                                   title="Format: 2kXX (e.g., 2k21, 2k25)"
                                   required>
                            <small class="form-text text-muted">Format: 2kXX (e.g., 2k21, 2k25)</small>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Add Batch
                        </button>
                    </form>
                </div>
            </div>

            <!-- Batches List -->
            <div class="col-lg-8">
                <div class="card p-4">
                    <h2 class="h4 mb-3">Existing Batches ({{ $batches->count() }})</h2>
                    
                    @forelse($batches as $batch)
                        <div class="batch-item">
                            <div>
                                <div class="batch-name">{{ $batch->name }}</div>
                                <div class="resource-count">
                                    {{ $batch->academicResources->count() }} resource(s) • 
                                    Sort order: {{ $batch->sort_order }}
                                </div>
                            </div>
                            <div>
                                <form method="POST" action="{{ route('admin.batches.destroy', $batch) }}" 
                                      class="d-inline" 
                                      onsubmit="return confirm('Delete batch {{ $batch->name }}? This will fail if there are associated resources.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.3;"></i>
                            <p class="mt-3">No batches found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
