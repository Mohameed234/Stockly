@extends('layouts.app')

@section('title', 'Users')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Users</h5>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users.create') }}" class="btn btn-primary back-to-users-btn">
                        <i class="fas fa-plus"></i> Add New User
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 60px;">#</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    @if(auth()->user()->role === 'admin')
                                    <th class="text-end">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar-circle-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-info">
                                                <h6 class="mb-0">{{ $user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-envelope text-muted me-2"></i>
                                            {{ $user->email }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge active">
                                            <i class="fas fa-circle"></i>
                                            Active
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar text-muted me-2"></i>
                                            {{ $user->created_at->format('M d, Y') }}
                                        </div>
                                    </td>
                                    @if(auth()->user()->role === 'admin')
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary action-btn edit-btn" title="Edit User">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger action-btn delete-btn" title="Delete User">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        border-radius: 1rem;
        background: var(--light);
    }

    .card-header {
        background: none;
        padding: 1.5rem;
        border-bottom: 1px solid var(--light-gray);
        justify-content: space-between;
    }

    .card-body {
        padding: 1.5rem;
    }

    .avatar-circle-sm {
        width: 40px;
        height: 40px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        color: var(--dark);
        border-bottom-width: 1px;
        background: var(--light-gray);
        padding: 1rem;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(5, 127, 242, 0.05);
    }
    .user-info{
        margin-bottom: 0px !important;
    }

    .user-info h6 {
        font-weight: 600;
        color: var(--dark);
        margin: 0;
        padding: 0;
        line-height: 1;
    }

    .role-badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
        border-radius: 0.5rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-badge.active {
        background: rgba(46, 204, 113, 0.1);
        color: #2ecc71;
    }

    .status-badge i {
        font-size: 0.5rem;
    }

    .btn-light {
        background: var(--light-gray);
        border: none;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-light:hover {
        background: var(--primary);
        color: white !important;
    }

    .add-user-btn {
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

    .add-user-btn:hover {
        background: #1a4b8c;
        box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        color: white;
    }

    .add-user-btn:active {
        background: #1a4b8c;
    }

    .text-muted {
        color: #6c757d !important;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .d-flex {
        display: flex !important;
    }

    .justify-content-end {
        justify-content: flex-end !important;
    }

    .gap-2 {
        gap: 0.5rem !important;
    }

    .header-left {
        flex: 1;
    }

    .header-right {
        margin-left: 2rem;
    }

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            gap: 1rem;
        }

        .header-right {
            margin-left: 0;
            width: 100%;
        }

        .add-user-btn {
            width: 100%;
            justify-content: center;
        }
    }

    .alert {
        border: none;
        border-radius: 1rem;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .alert-success {
        background: rgba(46, 204, 113, 0.1);
        color: #2ecc71;
    }

    .alert-danger {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
    }

    .alert i {
        font-size: 1.25rem;
    }

    .delete-user-btn {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .delete-user-btn:hover {
        background: #e74c3c !important;
        color: white !important;
        cursor: pointer;
    }

    .delete-user-btn:active {
        transform: scale(0.95);
    }

    .modal-content {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 1px solid var(--light-gray);
        padding: 1.5rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        border-top: 1px solid var(--light-gray);
        padding: 1.5rem;
    }

    .delete-icon {
        width: 80px;
        height: 80px;
        background: rgba(231, 76, 60, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    .delete-icon i {
        font-size: 2.5rem;
        color: #e74c3c;
    }

    .delete-confirm-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #e74c3c;
        border: none;
        color: white;
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.2);
        transition: all 0.3s ease;
    }

    .delete-confirm-btn:hover {
        background: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
    }

    .delete-confirm-btn:active {
        transform: translateY(0);
    }

    .btn-light {
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-light:hover {
        background: var(--light-gray);
    }

    /* SweetAlert2 Custom Styles */
    .delete-confirmation-popup {
        border-radius: 1rem !important;
        padding: 2rem !important;
    }

    .delete-confirmation {
        text-align: center;
        padding: 1rem 0;
    }

    .delete-confirmation .delete-icon {
        width: 80px;
        height: 80px;
        background: rgba(231, 76, 60, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        animation: pulse 2s infinite;
    }

    .delete-confirmation .delete-icon i {
        font-size: 2.5rem;
        color: #e74c3c;
    }

    .delete-confirmation-title {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        color: var(--dark) !important;
    }

    .delete-confirmation-content {
        font-size: 1.1rem !important;
        color: var(--dark) !important;
    }

    .delete-confirmation-button {
        padding: 0.75rem 1.5rem !important;
        font-size: 1rem !important;
        font-weight: 500 !important;
        border-radius: 0.75rem !important;
        background: #e74c3c !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.2) !important;
        transition: all 0.3s ease !important;
    }

    .delete-confirmation-button:hover {
        background: #c0392b !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3) !important;
    }

    .delete-confirmation-cancel-button {
        padding: 0.75rem 1.5rem !important;
        font-size: 1rem !important;
        font-weight: 500 !important;
        border-radius: 0.75rem !important;
        background: var(--light-gray) !important;
        border: none !important;
        transition: all 0.3s ease !important;
    }

    .delete-confirmation-cancel-button:hover {
        background: #e9ecef !important;
        transform: translateY(-2px) !important;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.4);
        }
        70% {
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(231, 76, 60, 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(231, 76, 60, 0);
        }
    }

    /* Animate.css for animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translate3d(0, -20px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeOutUp {
        from {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
        to {
            opacity: 0;
            transform: translate3d(0, -20px, 0);
        }
    }

    .animate__animated {
        animation-duration: 0.3s;
    }

    .animate__fadeInDown {
        animation-name: fadeInDown;
    }

    .animate__fadeOutUp {
        animation-name: fadeOutUp;
    }

    .animate__faster {
        animation-duration: 0.2s;
    }

    /* Action Buttons Styling */
    .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .action-btn i {
        font-size: 0.875rem;
    }

    .edit-btn {
        background: var(--primary);
        color: white;
    }

    .edit-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
    }

    .delete-btn {
        background: #e74c3c;
        color: white;
    }

    .delete-btn:hover {
        background: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(231, 76, 60, 0.2);
    }

    .action-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Remove old button styles */
    .btn-sm {
        padding: 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-sm:hover {
        transform: translateY(-2px);
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
    }

    .btn-danger {
        background: #e74c3c;
        border: none;
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.2);
    }

    .btn-danger:hover {
        background: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
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
    }

    .back-to-users-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 127, 242, 0.3);
        background: var(--primary-dark);
        color: white;
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this user?')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endpush
@endsection
