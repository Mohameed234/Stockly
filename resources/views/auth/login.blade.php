<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stockly') }} - Login</title>

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
        }
        .login-card > .row {
        }
        .login-image {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            padding: 30px 25px;
            color: var(--light);
            position: relative;
            overflow: hidden;
            height: 100%;
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
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        .login-image .lead {
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            opacity: 0.9;
            line-height: 1.4;
        }
        .feature-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: var(--light);
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 10px;
        }
        .feature-item {
            margin-bottom: 15px;
            padding: 0 5px;
            display: flex;
            align-items: center;
        }
        .feature-item h6 {
            font-size: 0.9rem;
            margin-bottom: 2px;
            color: var(--light);
            font-weight: 600;
        }
        .feature-item small {
            font-size: 0.8rem;
            color: var(--light);
            opacity: 0.9;
            line-height: 1.2;
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
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
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
        .feature-item:nth-child(1) .feature-icon {
            background: rgba(2, 2, 0, 0.1);
            color: var(--dark);
        }
        .feature-item:nth-child(2) .feature-icon {
            background: rgba(2, 2, 0, 0.1);
            color: var(--dark);
        }
        .feature-item:nth-child(3) .feature-icon {
            background: rgba(2, 2, 0, 0.1);
            color: var(--dark);
        }
        .feature-item:nth-child(4) .feature-icon {
            background: rgba(2, 2, 0, 0.1);
            color: var(--dark);
        }
        /* Login Header */
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
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            color: var(--light);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('images/logo no back.png') }}" alt="Stockly Logo" class="login-logo mb-4">
                <h1 class="login-title">Welcome Back!</h1>
                <p class="login-subtitle">Sign in to continue to Stockly.</p>
            </div>
            <div class="row g-0">
                <!-- Left Side - Login Form -->
                <div class="col-lg-6 p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            </div>
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                            </div>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Side - Image/Features -->
                <div class="col-lg-6 login-image d-flex align-items-center justify-content-center">
                    <div class="text-center px-4">
                        <h2 class="fw-bold mb-4">Efficient Inventory Management</h2>
                        <p class="lead mb-5">Streamline your stock, track movements, and gain insights with ease.</p>
                        <div class="row text-start g-4">
                            <div class="col-12 col-md-6 feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-cubes"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Stock Control</h6>
                                    <small>Monitor inventory levels in real-time</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Advanced Analytics</h6>
                                    <small>Get insights into your inventory performance</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-warehouse"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Multi-Warehouse Support</h6>
                                    <small>Manage stock across multiple locations</small>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">QR Code Scanning</h6>
                                    <small>Quick and accurate item tracking</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
