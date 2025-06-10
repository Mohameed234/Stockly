<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stockly') }} - Reset Password</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #057ff2;
            --primary-light: #4ba3ff;
            --primary-dark: #0468c9;
            --dark: #020200;
            --dark-light: #1a1a1a;
            --light: #fdfdfd;
            --light-gray: #f5f5f5;
            --accent: #ff6b6b;
            --accent-light: #ff8e8e;
            --success: #2ecc71;
            --warning: #f1c40f;
        }
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: var(--light-gray);
            min-height: 100vh;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: var(--light);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(2, 2, 0, 0.3);
            overflow: hidden;
            width: 1000px;
            max-width: 100%;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }
        .login-card > .row {
            flex: 1;
            overflow: hidden;
        }
        .login-image {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 2.5rem;
            color: var(--light);
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .login-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-3.134-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1'/%3E%3C/svg%3E');
            opacity: 0.1;
        }
        .login-image h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }
        .login-image .lead {
            font-size: 0.95rem;
            /* margin-bottom: 2rem; */
            opacity: 0.9;
            line-height: 1.4;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            /* margin-top: 1rem; */
        }
        .feature-item {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            background: rgba(255, 255, 255, 0.15);
            /* transform: translateY(-2px); */
        }
        .feature-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            color: var(--light);
            font-size: 1.1rem;
        }
        .feature-content {
            flex: 1;
        }
        .feature-content h6 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: var(--light);
        }
        .feature-content small {
            font-size: 0.8rem;
            color: var(--light);
            opacity: 0.9;
            line-height: 1.4;
            display: block;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid var(--light-gray);
            background-color: var(--light);
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(5, 127, 242, 0.1);
            border-color: var(--primary);
            background-color: var(--light);
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(5, 127, 242, 0.4);
        }
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .input-group-text {
            background-color: var(--light-gray);
            border: 1px solid var(--light-gray);
            border-radius: 10px;
            color: var(--primary);
        }
        .login-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .text-primary {
            color: var(--primary) !important;
        }
        .text-muted {
            color: var(--dark-light) !important;
        }
        .form-label {
            color: var(--dark);
            font-weight: 500;
        }
        .text-decoration-none {
            color: var(--primary);
        }
        .text-decoration-none:hover {
            color: var(--primary-dark);
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
        .row.text-start.g-4 {
            gap: 0.4rem !important;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, auto);
            overflow-y: auto;
            padding-right: 10px;
            max-height: calc(100% - 120px);
        }
        .col-lg-6.p-5 {
            overflow-y: auto;
            max-height: calc(100vh - 200px);
        }
        .btn-link {
            color: var(--primary);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .btn-link:hover {
            color: var(--primary-dark);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('images/logo no back.png') }}" alt="Stockly Logo" class="login-logo mb-4">
                <h1 class="login-title">Reset Password</h1>
                <p class="login-subtitle">Enter your new password below.</p>
            </div>
            <div class="row g-0">
                <!-- Left Side - Reset Form -->
                <div class="col-lg-6 p-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="mb-4">
                            <label for="password" class="form-label">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required autocomplete="new-password">
                            </div>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        @error('token')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @error('error')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-link text-center">
                                Back to Login
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Right Side - Features -->
                <div class="col-lg-6 login-image">
                    <div class="text-center mb-4">
                        <h2>Secure Password Reset</h2>
                        <p class="lead">Create a strong password to protect your account</p>
                    </div>

                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Strong Password</h6>
                                <small>Use a combination of letters, numbers, and symbols</small>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Password Confirmation</h6>
                                <small>Verify your new password to ensure accuracy</small>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Secure Reset</h6>
                                <small>Your password will be updated immediately</small>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div class="feature-content">
                                <h6>Login Ready</h6>
                                <small>Sign in with your new password after reset</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
