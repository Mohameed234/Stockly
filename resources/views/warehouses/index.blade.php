@extends('layouts.app')

@section('title', 'Warehouses')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center"
                    style="justify-content: space-between;display: flex;">
                        <div class="header-left">
                            <h5 class="mb-0">Warehouses</h5>
                            <p class="text-muted mb-0">Manage your warehouse locations</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('warehouses.create') }}" class="btn btn-primary add-warehouse-btn">
                                <i class="fas fa-plus"></i> Add New Warehouse
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Item</th>
                                    <th>Created At</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($warehouses as $warehouse)
                                    <tr class="clickable-row" onclick="window.location.href='{{ route('warehouses.show', $warehouse) }}'">
                                        <td>{{ $warehouse->name }}</td>
                                        <td>{{ $warehouse->location }}</td>
                                        <td>
                                            @if($warehouse->items->count() > 0)
                                                <div class="items-list">
                                                    @foreach($warehouse->items as $item)
                                                        <span class="item-badge">{{ $item->type }} - {{ $item->measurement }} ({{ number_format($item->pivot->quantity, 0) }})</span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">No items assigned</span>
                                            @endif
                                        </td>
                                        <td>{{ $warehouse->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="d-flex gap-2" style="display: flex;" onclick="event.stopPropagation()">
                                                <a href="{{ route('warehouses.edit', $warehouse) }}" class="btn btn-sm btn-primary action-btn edit-btn" title="Edit Warehouse">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('warehouses.destroy', $warehouse) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger action-btn delete-btn" title="Delete Warehouse">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="fas fa-warehouse fa-3x mb-3"></i>
                                                <p class="mb-0">No warehouses found</p>
                                                <a href="{{ route('warehouses.create') }}" class="btn btn-primary mt-3">
                                                    <i class="fas fa-plus"></i> Add New Warehouse
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $warehouses->links() }}
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
    }

    .card-body {
        padding: 1.5rem;
    }


    .add-warehouse-btn {
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

    .add-warehouse-btn:hover {
        background: #1a4b8c;
        box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        color: white;
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

    .action-btn {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .action-btn.edit-btn {
        background: var(--primary);
        border: none;
        color: white;
    }

    .action-btn.edit-btn:hover {
        background: #1a4b8c;
        transform: translateY(-2px);
    }

    .action-btn.delete-btn {
        background: #dc3545;
        border: none;
        color: white;
    }

    .action-btn.delete-btn:hover {
        background: #bb2d3b;
        transform: translateY(-2px);
        cursor: pointer;
    }

    .empty-state {
        text-align: center;
        color: var(--dark-light);
    }

    .empty-state i {
        color: var(--light-gray);
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

    .items-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.25rem;
    }

    .item-badge {
        background: var(--primary);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .warehouse-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .warehouse-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    .clickable-row {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .clickable-row:hover {
        background-color: rgba(5, 127, 242, 0.1) !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .clickable-row td {
        position: relative;
    }

    .clickable-row td:last-child {
        position: relative;
        z-index: 10;
    }

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .header-right {
            width: 100%;
        }

        .add-warehouse-btn {
            width: 100%;
            justify-content: center;
        }

        .table-responsive {
            margin: 0 -1.5rem;
        }

        .action-btn {
            width: 28px;
            height: 28px;
        }
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
    // Delete confirmation
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
@endsection
