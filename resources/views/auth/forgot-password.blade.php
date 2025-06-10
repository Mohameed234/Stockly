<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Forgot Password</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('images/logo no back.png') }}" alt="Stockly Logo" class="login-logo mb-4">
                <h1 class="login-title">Forgot Password</h1>
                <p class="login-subtitle">Enter your email to reset your password.</p>
            </div>
            <div class="row g-0">
                <!-- Left Side - Reset Form -->
                <div class="col-lg-6 p-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Send Password Reset Link
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-link text-center">
                                Back to Login
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Right Side - Image/Features -->
                <div class="col-lg-6 login-image d-flex align-items-center justify-content-center">
                    <div class="text-center px-4">
                        <h2 class="fw-bold mb-4">Secure Password Reset</h2>
                        <p class="lead mb-5">We'll help you get back into your account safely and securely.</p>
                        <div class="row text-start g-4">
                            <div class="col-12 col-md-6 feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Secure Process</h6>
                                    <small>Your data is always protected</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email Verification</h6>
                                    <small>Reset link sent to your email</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Quick Process</h6>
                                    <small>Reset your password in minutes</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Strong Security</h6>
                                    <small>Enhanced password protection</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #057ff2;
            --primary-light: #4ba3ff;
            --primary-dark: #0468c9;
            --dark: #020200;
            --dark-light: #1a1a1a;
            --light: #fdfdfd;
            --light-gray: #f5f5f5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-gray);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            height: 100vh;
            max-height: 600px;
            display: flex;
            align-items: center;
        }

        .login-card {
            background: var(--light);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .login-header {
            text-align: center;
            margin-bottom: 0;
            background-color: var(--dark);
            padding: 20px;
            width: 100%;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .login-header .login-logo {
            max-width: 220px;
            height: auto;
            margin: 0 auto 0.75rem auto;
        }

        .login-header .login-title {
            font-size: 1.75rem;
            margin-bottom: 0.25rem;
        }

        .login-header .login-subtitle {
            font-size: 0.9rem;
        }

        .login-logo {
            max-width: 200px;
            height: auto;
            margin: 0 auto;
            background-color: var(--dark);
        }

        .login-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            color: var(--light);
        }

        .row.g-0 {
            flex: 1;
            margin: 0;
        }

        .col-lg-6.p-5 {
            padding: 1.5rem !important;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-image {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .text-center.px-4 {
            padding: 0 !important;
        }

        .text-center h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            margin-top: -0.5rem;
        }

        .text-center .lead {
            font-size: 0.9rem;
            margin-bottom: 1rem !important;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.4rem;
            transition: all 0.3s ease;
            margin-bottom: 0.4rem;
            width: 100%;
        }

        .feature-icon {
            width: 25px;
            height: 25px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .feature-item h6 {
            margin: 0;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .feature-item small {
            opacity: 0.8;
            font-size: 0.65rem;
        }

        .form-label {
            font-size: 0.9rem;
        }

        .input-group {
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            padding: 0.5rem 0.75rem;
        }

        .form-control {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
        }

        .btn-primary {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .btn-link {
            font-size: 0.85rem;
        }

        .alert {
            padding: 0.75rem;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .row.text-start.g-4 {
            gap: 0.4rem !important;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, auto);
        }

        .col-12.col-md-6 {
            width: 100%;
            max-width: 100%;
        }

        @media (max-width: 991.98px) {
            .login-container {
                height: auto;
                max-height: none;
            }

            .login-card {
                height: auto;
            }

            .login-image {
                min-height: 200px;
            }
        }
    </style>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
