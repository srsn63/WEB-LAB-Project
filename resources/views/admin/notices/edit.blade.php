<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notice | KUET CSE Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(160deg, #020617 0%, #0f172a 45%, #1e293b 100%);
            min-height: 100vh;
            color: #e2e8f0;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: rgba(15, 23, 42, 0.9) !important;
            border-bottom: 1px solid rgba(148, 163, 184, 0.25);
        }
        .card-glass {
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 24px;
            box-shadow: 0 24px 80px rgba(30, 64, 175, 0.35);
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            font-weight: 600;
        }
        .btn-outline-light {
            border-color: rgba(148, 163, 184, 0.4);
            color: #e2e8f0;
        }
        .btn-secondary {
            background: rgba(148, 163, 184, 0.2);
            border: 1px solid rgba(148, 163, 184, 0.4);
            color: #e2e8f0;
        }
        .form-control, .form-select {
            background: rgba(2, 6, 23, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.25);
            color: #f8fafc;
        }
        .form-control:focus {
            background: rgba(2, 6, 23, 0.9);
            box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.25);
            border-color: rgba(56, 189, 248, 0.6);
        }
        label {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        label span {
            color: #f87171;
        }
        .text-secondary {
            color: #94a3b8 !important;
        }
        .invalid-feedback {
            color: #f87171;
        }
        .is-invalid {
            border-color: #f87171 !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <span class="navbar-brand fw-semibold">KUET CSE Admin</span>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">Back to Dashboard</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    @if(session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-glass">
                <div class="card-body p-4">
                    <h2 class="card-title h4 mb-3">Edit Notice: {{ $notice->title }}</h2>
                    <p class="text-secondary">Update the notice details below. All fields are required.</p>

                    <form method="POST" action="{{ route('admin.notices.update', $notice) }}" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Notice Title <span>*</span></label>
                                <input type="text" name="title" value="{{ old('title', $notice->title) }}" class="form-control @error('title') is-invalid @enderror" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Notice Content <span>*</span></label>
                                <textarea name="content" rows="8" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $notice->content) }}</textarea>
                                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Update Notice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>