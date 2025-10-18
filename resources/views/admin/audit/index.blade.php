<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0d0f14; color: #eaeefb; }
        .card { background: #12141b; border: 1px solid #1f2330; }
        .table { color: #eaeefb; }
        .table thead th { color: #9fb2ff; border-bottom-color: #1f2330; }
        .table tbody tr { border-color: #1f2330; }
        .badge-role { background: #2b2f3b; color: #d1d9ff; }
        .text-dim { color: #9aa6c0; }
    </style>
 </head>
<body class="p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 m-0">Audit Logs</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary">Back to Dashboard</a>
        </div>

        <div class="card p-3">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>When</th>
                            <th>Actor</th>
                            <th>Action</th>
                            <th>Target</th>
                            <th>Changes</th>
                            <th class="text-end">Meta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td class="text-dim">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <span class="badge badge-role text-uppercase">{{ $log->actor_type ?? 'guest' }}</span>
                                    <div>{{ $log->actor_name ?? ('#'.$log->actor_id) }}</div>
                                </td>
                                <td>{{ ucfirst($log->action) }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $log->target_type }}</div>
                                    <div class="text-dim">{{ $log->target_name ?? ('ID: '.$log->target_id) }}</div>
                                </td>
                                <td style="max-width: 380px;">
                                    @if($log->changed_fields)
                                        <pre class="mb-0 small text-dim" style="white-space: pre-wrap;">{{ json_encode($log->changed_fields, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    @else
                                        <span class="text-dim">—</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="text-dim">IP: {{ $log->ip_address ?? '—' }}</div>
                                    <div class="small text-dim">UA: {{ \Illuminate\Support\Str::limit($log->user_agent ?? '—', 40) }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-dim">No audit entries yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                {{ $logs->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
