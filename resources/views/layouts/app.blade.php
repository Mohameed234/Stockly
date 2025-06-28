<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @auth
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('images/logo no back.png') }}" alt="Stockly Logo" class="logo-img">
                </div>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="sidebar-content">
                <a href="{{ route('profile.show') }}" class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <h6 class="user-name">{{ Auth::user()->name }}</h6>
                        <span class="user-role">{{ Auth::user()->role }}</span>
                    </div>
                </a>

                <nav class="sidebar-nav">
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <a href="{{ route('items.index') }}" class="nav-item {{ request()->routeIs('items.*') ? 'active' : '' }}" title="Items">
                        <i class="fas fa-box"></i>
                        <span class="nav-text">Items</span>
                    </a>
                    <div class="nav-group">
                        <a href="{{ route('warehouses.index') }}" class="nav-item {{ request()->routeIs('warehouses.*') && !request()->routeIs('transfers.*') ? 'active' : '' }}" title="Warehouses">
                            <i class="fas fa-warehouse"></i>
                            <span class="nav-text">Warehouses</span>
                        </a>
                        <a href="{{ route('transfers.index') }}" class="nav-item {{ request()->routeIs('transfers.*') ? 'active' : '' }}" title="Transfers">
                            <i class="fas fa-exchange-alt"></i>
                            <span class="nav-text">Transfers</span>
                        </a>
                    </div>
                    <a href="{{ route('users.index') }}" class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}" title="Users">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </nav>
            </div>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-text">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <nav class="top-nav">
                <div class="nav-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                </div>
                <div class="nav-right">
                    <button class="nav-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <button class="nav-btn">
                        <i class="fas fa-envelope"></i>
                        <span class="notification-badge">5</span>
                    </button>
                </div>
            </nav>
        @endauth

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

        @auth
        </div>
        @endauth
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
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --top-nav-height: 70px;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background: var(--light-gray);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--light);
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar.collapsed .logo {
            display: none;
        }

        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .user-details {
            display: none;
        }

        .sidebar.collapsed .nav-item,
        .sidebar.collapsed .logout-btn {
            justify-content: center;
            padding: 0.875rem;
        }

        .sidebar.collapsed .user-info {
            justify-content: center;
            padding: 0.4rem;
            background: var(--primary);
            border-radius: 0.5rem;
            /* margin: 0.5rem; */
        }

        .sidebar-header {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--light-gray);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--dark);
            padding: 0.5rem;
            border-radius: 0.5rem;
        }

        .logo-img {
            max-width: 180px;
            height: auto;
            transition: all 0.3s ease;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--dark);
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: var(--light-gray);
        }

        .sidebar-content {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--light-gray);
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
        }

        .user-info:hover {
            background: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        }

        .user-info:hover .user-name,
        .user-info:hover .user-role {
            color: var(--light);
        }

        .user-info:hover .user-avatar {
            background: var(--light);
            color: var(--primary);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light);
            transition: all 0.3s ease;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            margin: 0;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--dark);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--dark-light);
            text-transform: capitalize;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            color: var(--dark);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            background: var(--light-gray);
        }

        .nav-item.active {
            background: var(--primary);
            color: var(--light);
        }

        .nav-item i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }

        .nav-text {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .sidebar-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--light-gray);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 1rem;
            width: 100%;
            padding: 0.875rem 1rem;
            background: none;
            border: none;
            color: var(--dark);
            font-size: 0.875rem;
            font-weight: 500;
            text-align: left;
            cursor: pointer;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #dc3545;
            color: var(--light);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed + .main-content {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Navigation Styles */
        .top-nav {
            height: var(--top-nav-height);
            background: var(--light);
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--dark);
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: var(--light-gray);
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--light-gray);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            width: 300px;
        }

        .search-box i {
            color: var(--dark-light);
        }

        .search-box input {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 0.875rem;
            color: var(--dark);
        }

        .search-box input::placeholder {
            color: var(--dark-light);
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-btn {
            background: none;
            border: none;
            color: var(--dark);
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-btn:hover {
            background: var(--light-gray);
        }

        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: var(--primary);
            color: var(--light);
            font-size: 0.75rem;
            font-weight: 600;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .search-box {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .search-box {
                display: none;
            }
        }

        .nav-group {
            margin-bottom: 0.5rem;
        }

        .nav-sub-item {
            margin-left: 1.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
            background: rgba(5, 127, 242, 0.05);
            border-left: 3px solid var(--primary);
        }

        .nav-sub-item:hover {
            background: rgba(5, 127, 242, 0.1);
        }

        .nav-sub-item.active {
            background: var(--primary);
            color: var(--light);
        }

        .sidebar.collapsed .nav-sub-item {
            margin-left: 0;
            padding: 0.5rem;
            font-size: 0.75rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const menuToggle = document.getElementById('menuToggle');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                });
            }

            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 1024) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickOnMenuToggle = menuToggle.contains(event.target);

                    if (!isClickInsideSidebar && !isClickOnMenuToggle && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        });
    </script>
</body>
</html>
