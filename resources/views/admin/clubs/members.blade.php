<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members - {{ $club->name }} | Admin</title>
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
        .badge-president { background: linear-gradient(135deg, #dc2626, #f59e0b); color: #fff; }
        .badge-vp { background: linear-gradient(135deg, #8b5cf6, #a78bfa); color: #fff; }
        .badge-secretary { background: linear-gradient(135deg, #2563eb, #38bdf8); color: #fff; }
        .badge-treasurer { background: linear-gradient(135deg, #10b981, #34d399); color: #fff; }
        .badge-executive { background: linear-gradient(135deg, #f59e0b, #fbbf24); color: #000; }
        .badge-member { background: #6b7280; color: #fff; }
        .badge-active { background: #22c55e; color: #fff; }
        .badge-inactive { background: #6b7280; color: #fff; }
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
            <span class="navbar-brand fw-semibold">KUET CSE Admin - Manage Club Members</span>
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
            <p class="mb-0">{{ $club->short_name }}</p>
        </div>

        @if(session('status'))
            <div class="alert alert-success mb-4">{{ session('status') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif

        @php
            $currentPresident = $club->members()->where('role', 'President')->first();
        @endphp
        @if($currentPresident)
            <div class="alert alert-info mb-4" style="background: rgba(59, 130, 246, 0.1); border: 1px solid #3b82f6; color: #60a5fa;">
                <i class="bi bi-info-circle"></i> <strong>Current President:</strong> {{ $currentPresident->student->name ?? 'N/A' }}
                <small class="d-block mt-1">Only one President is allowed per club. To assign a new President, change the current President's role first.</small>
            </div>
        @else
            <div class="alert alert-warning mb-4" style="background: rgba(245, 158, 11, 0.1); border: 1px solid #f59e0b; color: #fbbf24;">
                <i class="bi bi-exclamation-triangle"></i> <strong>No President assigned yet.</strong> Consider assigning a President for this club.
            </div>
        @endif

        <div class="row g-4">
            <!-- Add Member Form -->
            <div class="col-lg-5">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-person-plus"></i> Add Member</h2>
                    <form method="POST" action="{{ route('admin.clubs.add-member', $club) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select Student *</label>
                            <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                <option value="">Choose a student...</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }} ({{ $student->student_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role *</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">Select role...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Joined Date *</label>
                            <input type="date" name="joined_date" class="form-control @error('joined_date') is-invalid @enderror" 
                                   value="{{ old('joined_date', date('Y-m-d')) }}" required>
                            @error('joined_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Responsibilities</label>
                            <textarea name="responsibilities" class="form-control @error('responsibilities') is-invalid @enderror" 
                                      rows="3" placeholder="Member's specific responsibilities...">{{ old('responsibilities') }}</textarea>
                            @error('responsibilities')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active Member</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-person-plus"></i> Add Member
                        </button>
                    </form>
                </div>
            </div>

            <!-- List of Members -->
            <div class="col-lg-7">
                <div class="card p-4">
                    <h2 class="h4 mb-3"><i class="bi bi-people"></i> Club Members ({{ $club->members->count() }})</h2>
                    
                    @if($club->members->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($club->members as $member)
                                        <tr>
                                            <td>
                                                <strong>{{ $member->student->name ?? 'N/A' }}</strong>
                                                @if($member->student->student_id)
                                                    <br><small class="text-muted">{{ $member->student->student_id }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($member->role == 'President')
                                                    <span class="badge badge-president">{{ $member->role }}</span>
                                                @elseif($member->role == 'Vice President')
                                                    <span class="badge badge-vp">{{ $member->role }}</span>
                                                @elseif($member->role == 'Secretary')
                                                    <span class="badge badge-secretary">{{ $member->role }}</span>
                                                @elseif($member->role == 'Treasurer')
                                                    <span class="badge badge-treasurer">{{ $member->role }}</span>
                                                @elseif($member->role == 'Executive Member')
                                                    <span class="badge badge-executive">{{ $member->role }}</span>
                                                @else
                                                    <span class="badge badge-member">{{ $member->role }}</span>
                                                @endif
                                                @if($member->responsibilities)
                                                    <br><small class="text-muted">{{ Str::limit($member->responsibilities, 30) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <small>{{ \Carbon\Carbon::parse($member->joined_date)->format('M d, Y') }}</small>
                                            </td>
                                            <td>
                                                @if($member->is_active)
                                                    <span class="badge badge-active">Active</span>
                                                @else
                                                    <span class="badge badge-inactive">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-warning" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editModal{{ $member->id }}" 
                                                            title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.clubs.remove-member', [$club, $member]) }}" 
                                                          onsubmit="return confirm('Remove this member from the club?')" 
                                                          style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Remove">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="editModal{{ $member->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content" style="background: #1a1a1a; border: 2px solid #333;">
                                                            <div class="modal-header" style="border-bottom-color: #333;">
                                                                <h5 class="modal-title">Edit Member</h5>
                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <form method="POST" action="{{ route('admin.clubs.update-member', [$club, $member]) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Student</label>
                                                                        <input type="text" class="form-control" value="{{ $member->student->name ?? 'N/A' }}" disabled>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Role *</label>
                                                                        <select name="role" class="form-select" required>
                                                                            @foreach($roles as $role)
                                                                                <option value="{{ $role }}" {{ $member->role == $role ? 'selected' : '' }}>{{ $role }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Responsibilities</label>
                                                                        <textarea name="responsibilities" class="form-control" rows="3">{{ $member->responsibilities }}</textarea>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" name="is_active" class="form-check-input" 
                                                                               id="edit_is_active{{ $member->id }}" value="1" 
                                                                               {{ $member->is_active ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="edit_is_active{{ $member->id }}">Active Member</label>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer" style="border-top-color: #333;">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Update Member</button>
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
                        <p class="text-center text-muted py-4">No members yet. Add your first member using the form.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add confirmation when changing to President role
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form[action*="members"]');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const roleSelect = this.querySelector('select[name="role"]');
                    if (roleSelect && roleSelect.value === 'President') {
                        const confirmed = confirm('Are you sure you want to assign this member as President? Only one President is allowed per club. Any existing President will need to be changed first.');
                        if (!confirmed) {
                            e.preventDefault();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
