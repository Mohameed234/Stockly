@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card profile-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center"
                                style="
                                justify-content: space-between;
                                display: flex;">
                        <div class="header-left">
                            <h5 class="mb-0">My Profile</h5>
                            <p class="text-muted mb-0">View and manage your account information</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-primary edit-profile-btn">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="profile-info">
                        <div class="profile-avatar">
                            <div class="avatar-circle">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        </div>

                        <div class="profile-details">
                            <div class="info-group">
                                <label>Name</label>
                                <p>{{ $user->name }}</p>
                            </div>

                            <div class="info-group">
                                <label>Email</label>
                                <p>{{ $user->email }}</p>
                            </div>

                            <div class="info-group">
                                <label>Role</label>
                                <p><span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">{{ ucfirst($user->role) }}</span></p>
                            </div>

                            <div class="info-group">
                                <label>Member Since</label>
                                <p>{{ $user->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        border-radius: 1rem;
        background: var(--light);
    }

    .card-header {
        background: none;
        padding: 1.5rem;
        border-bottom: 1px solid var(--light-gray);
    }

    .card-body {
        padding: 2rem;
    }

    .profile-info {
        display: flex;
        gap: 2rem;
        align-items: flex-start;
    }

    .profile-avatar {
        flex-shrink: 0;
    }

    .avatar-circle {
        width: 120px;
        height: 120px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        font-weight: 600;
    }

    .profile-details {
        flex: 1;
    }

    .info-group {
        margin-bottom: 1.5rem;
    }

    .info-group:last-child {
        margin-bottom: 0;
    }

    .info-group label {
        display: block;
        font-size: 0.875rem;
        color: var(--dark-light);
        margin-bottom: 0.5rem;
    }

    .info-group p {
        margin: 0;
        font-size: 1.125rem;
        color: var(--dark);
        font-weight: 500;
    }

    .edit-profile-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary);
        border: none;
        color: white;
        box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        transition: all 0.3s ease;
    }

    .edit-profile-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(5, 127, 242, 0.3);
        color: white;
    }

    .badge {
        padding: 0.5em 1em;
        font-weight: 500;
        border-radius: 0.5rem;
    }

    @media (max-width: 768px) {
        .profile-info {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-avatar {
            margin-bottom: 1.5rem;
        }

        .card-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .header-right {
            width: 100%;
        }

        .edit-profile-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
