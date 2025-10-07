<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top, #0f172a, #020617 70%);
            color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(148, 163, 184, 0.2);
            box-shadow: 0 20px 80px rgba(59, 130, 246, 0.35);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 460px;
            position: relative;
            overflow: hidden;
        }
        .login-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.14), transparent 60%);
            pointer-events: none;
        }
        .login-card h1 {
            font-size: 1.85rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        .login-card p.subtitle {
            color: rgba(148, 163, 184, 0.8);
            margin-bottom: 2rem;
        }
        .form-control, .form-control:focus {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: #f8fafc;
            box-shadow: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            border: none;
            font-weight: 600;
            padding: 0.85rem;
            border-radius: 999px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(56, 189, 248, 0.35);
        }
        .alert {
            border-radius: 16px;
            border: 1px solid rgba(59, 130, 246, 0.35);
            background: rgba(56, 189, 248, 0.08);
            color: #e0f2fe;
        }
        .form-text {
            color: rgba(148, 163, 184, 0.8);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Admin Control Center</h1>
        <p class="subtitle">Sign in to curate faculty profiles and keep the KUET CSE portal fresh.</p>

        @if(session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
        @endif

        @if($errors->has('auth'))
            <div class="alert alert-warning">{{ $errors->first('auth') }}</div>
        @endif

        @if(!empty($alreadyAuthenticated) && session('admin_id'))
            <div class="alert alert-warning">You're already signed in. <a href="{{ route('admin.dashboard') }}" class="alert-link">Continue to the dashboard</a>.</div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </form>
    </div>
</body>
</html>
