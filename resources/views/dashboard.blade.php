@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card">
                <div class="welcome-content">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="welcome-title mb-1">Welcome back, {{ Auth::user()->name }}! 👋</h2>
                            <p class="welcome-subtitle mb-0">Here's what's happening with your users today.</p>
                        </div>
                        <div class="text-end">
                            <div class="date-time-card">
                                <h3 class="mb-0">{{ now()->format('l, F j, Y') }}</h3>
                                <p class="mb-0">{{ now()->format('h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="d-flex justify-content-space-around flex-wrap mb-4 cards">
        <div class="stat-card">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-icon-wrapper">
                        <i class="fas fa-users stat-icon"></i>
                    </div>
                    <div class="stat-info">
                        <h6 class="stat-label">Total Users</h6>
                        <h3 class="stat-value">{{ \App\Models\User::count() }}</h3>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress">
                        <div class="progress-bar" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card-body">
                <div class="stat-content">
                    <div class="stat-icon-wrapper">
                        <i class="fas fa-user-shield stat-icon"></i>
                    </div>
                    <div class="stat-info">
                        <h6 class="stat-label">Admin Users</h6>
                        <h3 class="stat-value">{{ \App\Models\User::where('role', 'admin')->count() }}</h3>
                    </div>
                </div>
                <div class="stat-progress">
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="quick-actions-card">
                <div class="quick-actions-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="quick-actions-body">
                    <div class="d-grid gap-3">
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('users.create') }}" class="quick-action-btn">
                            <i class="fas fa-user-plus"></i>
                            <span>Add New User</span>
                        </a>
                        @endif
                        <a href="{{ route('users.index') }}" class="quick-action-btn">
                            <i class="fas fa-users"></i>
                            <span>View All Users</span>
                        </a>
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

    /* Welcome Card Styles */
    .welcome-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        border-radius: 1rem;
        padding: 2rem;
        color: var(--light);
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(5, 127, 242, 0.2);
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-title {
        font-size: 1.75rem;
        font-weight: 600;
    }

    .welcome-subtitle {
        font-size: 1rem;
        opacity: 0.9;
    }

    .date-time-card {
        background: rgba(255, 255, 255, 0.1);
        padding: 1rem;
        border-radius: 0.5rem;
    }

    /* Stats Card Styles */
    .stat-card {
        background: var(--light);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        flex: 1;
        min-width: 250px;
        margin: 0.5rem;
    }

    .stat-content {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stat-icon-wrapper {
        width: 48px;
        height: 48px;
        background: var(--primary-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .stat-icon {
        font-size: 1.5rem;
        color: var(--light);
    }

    .stat-info {
        flex: 1;
    }

    .stat-label {
        color: var(--dark-light);
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        color: var(--dark);
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    /* Quick Actions Styles */
    .quick-actions-card {
        background: var(--light);
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .quick-actions-header {
        margin-bottom: 1.5rem;
    }

    .quick-action-btn {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: var(--light-gray);
        border-radius: 0.5rem;
        color: var(--dark);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .quick-action-btn:hover {
        background: var(--primary-light);
        color: var(--light);
        transform: translateY(-2px);
    }

    .quick-action-btn i {
        font-size: 1.25rem;
        margin-right: 1rem;
    }

    .quick-action-btn span {
        font-weight: 500;
    }
    .sidebar.collapsed .user-info{
        padding: 0.3rem !important;
        margin: 0rem !important;
        margin-bottom: 1.5rem !important;
    }
</style>
@endsection
