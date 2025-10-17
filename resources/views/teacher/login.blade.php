<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login | KUET CSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-card {
            background: rgba(10, 14, 39, 0.95);
            border: 2px solid rgba(96, 165, 250, 0.3);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            max-width: 450px;
            width: 100%;
        }
        .login-card h1 {
            color: #60a5fa;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .login-card p {
            color: #94a3b8;
            margin-bottom: 2rem;
        }
        .form-label {
            color: #e2e8f0;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .form-control {
            background: rgba(15, 23, 42, 0.8);
            border: 2px solid rgba(71, 85, 105, 0.5);
            color: #f8fafc;
            padding: 0.75rem 1rem;
            border-radius: 10px;
        }
        .form-control:focus {
            background: rgba(15, 23, 42, 0.9);
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
            color: #f8fafc;
        }
        .form-control::placeholder {
            color: #64748b;
        }
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            margin-top: 1rem;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(96, 165, 250, 0.3);
        }
        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .form-check-input {
            background-color: rgba(15, 23, 42, 0.8);
            border-color: rgba(71, 85, 105, 0.5);
        }
        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        .form-check-label {
            color: #cbd5e1;
        }
        .back-link {
            display: block;
            text-align: center;
            color: #60a5fa;
            text-decoration: none;
            margin-top: 1.5rem;
        }
        .back-link:hover {
            color: #93c5fd;
        }
        .invalid-feedback {
            color: #fca5a5;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Teacher Portal</h1>
        <p>Sign in to access your dashboard and manage your profile.</p>

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('teacher.login') }}">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" 
                       placeholder="yourname@teachers.gmail.com" required autofocus>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>

        <a href="{{ route('home') }}" class="back-link">← Back to Homepage</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
