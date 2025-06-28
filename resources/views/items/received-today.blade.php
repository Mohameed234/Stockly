@extends('layouts.app')

@section('title', 'Items Received Today')

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
                            <h5 class="mb-0">Items Received Today</h5>
                            <p class="text-muted mb-0">Items that were received today</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('items.index') }}" class="btn btn-primary back-to-items-btn">
                                <i class="fas fa-arrow-left"></i> Back to All Items
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if($items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Measurement</th>
                                        <th>Amount</th>
                                        <th>QR Code</th>
                                        <th>In Date</th>
                                        <th>Expire Date</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Out Date</th>
                                        <th>Amount In</th>
                                        <th>Warehouses</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->measurement }}</td>
                                            <td>{{ number_format($item->amount, 2) }}</td>
                                            <td>{{ $item->qrcode ?? 'N/A' }}</td>
                                            <td>
                                                <span class="in-date text-primary fw-bold">
                                                    {{ $item->in_date ? $item->in_date->format('M d, Y') : 'N/A' }}
                                                </span>
                                            </td>
                                            <td>{{ $item->expire_date ? $item->expire_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>{{ $item->get_from }}</td>
                                            <td>{{ $item->get_to }}</td>
                                            <td>{{ $item->get_out_date ? $item->get_out_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>{{ number_format($item->amount_get_in, 2) }}</td>
                                            <td>
                                                @if($item->warehouses->count() > 0)
                                                    <div class="warehouses-list">
                                                        @foreach($item->warehouses as $warehouse)
                                                            <span class="warehouse-badge">{{ $warehouse->name }}</span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-muted">No warehouses assigned</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2" style="display: flex;">
                                                    <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-primary action-btn edit-btn" title="Edit Item">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger action-btn delete-btn" title="Delete Item">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                            <h5>No Items Received Today</h5>
                            <p class="text-muted">There are no items that were received today.</p>
                            <a href="{{ route('items.create') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus"></i> Add New Item
                            </a>
                        </div>
                    @endif
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

    .back-to-items-btn {
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

    .back-to-items-btn:hover {
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

    .in-date {
        font-weight: 500;
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

    .warehouses-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.25rem;
    }

    .warehouse-badge {
        background: #28a745;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        color: var(--dark-light);
    }

    .empty-state i {
        color: var(--light-gray);
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

        .back-to-items-btn {
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
