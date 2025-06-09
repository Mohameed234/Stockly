@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
@if(auth()->user()->role !== 'admin')
    <script>window.location = "{{ route('users.index') }}";</script>
@endif

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card edit-user-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="header-left">
                            <h5 class="mb-0">Edit User</h5>
                            <p class="text-muted mb-0">Update user information and permissions</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('users.index') }}" class="btn btn-primary back-to-users-btn">
                                <i class="fas fa-arrow-left"></i> Back to Users
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST" class="edit-user-form">
                        @csrf
                        @method('PUT')

                        <div class="form-rows">
                            <div class="form-row">
                                <div class="form-label">
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-input">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}" required
                                        placeholder="Enter name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">
                                    <label for="email">Email</label>
                                </div>
                                <div class="form-input">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}" required
                                        placeholder="Enter email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">
                                    <label for="current_password">Current Password</label>
                                </div>
                                <div class="form-input">
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password" name="current_password" placeholder="Enter current password">
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">
                                    <label for="password">New Password</label>
                                </div>
                                <div class="form-input">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter new password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">
                                    <label for="password_confirmation">Confirm New Password</label>
                                </div>
                                <div class="form-input">
                                    <input type="password" class="form-control"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Confirm new password">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">
                                    <label for="role">Role</label>
                                </div>
                                <div class="form-input">
                                    <select class="form-select @error('role') is-invalid @enderror"
                                        id="role" name="role" required>
                                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-primary update-btn">
                                <i class="fas fa-save"></i> Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .edit-user-card {
        border: none;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
        border-radius: 1.5rem;
        background: var(--light);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .edit-user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 35px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: none;
        padding: 2rem 2rem 1.5rem;
        border-bottom: 1px solid var(--light-gray);
    }

    .header-content h5 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .card-body {
        padding: 2rem;
    }

    .form-rows {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-row {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .form-label {
        flex: 0 0 200px;
        text-align: right;
    }

    .form-label label {
        font-weight: 500;
        color: var(--dark);
        margin: 0;
        font-size: 1rem;
    }

    .form-input {
        flex: 1;
    }

    .form-control,
    .form-select {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
        border-radius: 1rem;
        border: 2px solid var(--light-gray);
        background: white;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(5, 127, 242, 0.1);
    }

    .back-to-users-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 1rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary);
        border: none;
        color: white;
        box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .back-to-users-btn:hover {
        background: #1a4b8c;
        box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        color: white;
    }

    .back-to-users-btn:active {
        background: #1a4b8c;
    }

    .header-left {
        flex: 1;
    }

    .header-right {
        margin-left: 2rem;
        display: flex;
        justify-content: flex-end;
    }

    .update-btn {
        padding: 1rem 2.5rem;
        border-radius: 1rem;
        font-weight: 500;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        background: var(--primary);
        border: none;
        box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        color: white;
        cursor: pointer;
        margin-top: 1rem;
    }

    .update-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 127, 242, 0.3);
        color: white;
    }

    .update-btn:active {
        transform: translateY(0);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
    }

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            gap: 1rem;
        }

        .header-right {
            margin-left: 0;
            width: 100%;
            justify-content: center;
        }

        .back-to-users-btn {
            width: 100%;
            justify-content: center;
        }

        .card-header {
            padding: 1.5rem 1.5rem 1rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .header-content h5 {
            font-size: 1.25rem;
        }

        .form-row {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .form-label {
            flex: none;
            text-align: left;
            width: 100%;
        }

        .form-input {
            width: 100%;
        }
    }
</style>
@endsection
