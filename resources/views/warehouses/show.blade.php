@extends('layouts.app')

@section('title', $warehouse->name . ' - Items')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="header-left">
                            <h5 class="mb-0">{{ $warehouse->name }}</h5>
                            <p class="text-muted mb-0">Location: {{ $warehouse->location }}</p>
                            <p class="text-muted mb-0">Total Items: {{ $warehouse->items->count() }}</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('warehouses.index') }}" class="btn btn-primary back-to-warehouses-btn">
                                <i class="fas fa-arrow-left"></i> Back to Warehouses
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if($warehouse->items->count() > 0)
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
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($warehouse->items as $item)
                                        <tr>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->measurement }}</td>
                                            <td>{{ number_format($item->pivot->quantity, 2) }}</td>
                                            <td>{{ $item->qrcode ?? 'N/A' }}</td>
                                            <td>{{ $item->in_date->format('M d, Y') }}</td>
                                            <td>{{ $item->expire_date ? $item->expire_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>{{ $item->get_from }}</td>
                                            <td>{{ $item->get_to }}</td>
                                            <td>{{ $item->get_out_date ? $item->get_out_date->format('M d, Y') : 'N/A' }}</td>
                                            <td>{{ number_format($item->amount_get_in, 2) }}</td>
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
                            <i class="fas fa-box-open fa-3x mb-3"></i>
                            <h5>No Items Found</h5>
                            <p class="text-muted">This warehouse doesn't have any items assigned yet.</p>
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

    .back-to-warehouses-btn {
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

    .back-to-warehouses-btn:hover {
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

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .header-right {
            width: 100%;
        }

        .back-to-warehouses-btn {
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
