@extends('layouts.app')

@section('title', 'Transfers')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="header-left">
                            <h5 class="mb-0">Transfers</h5>
                            <p class="text-muted mb-0">Manage item transfers between warehouses</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('transfers.create') }}" class="btn btn-primary create-transfer-btn">
                                <i class="fas fa-plus"></i> New Transfer
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($transfers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Transfer ID</th>
                                        <th>Item</th>
                                        <th>From Warehouse</th>
                                        <th>To Warehouse</th>
                                        <th>Quantity</th>
                                        <th>Transfer Date</th>
                                        <th>Transferred By</th>
                                        <th>Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transfers as $transfer)
                                        <tr>
                                            <td>
                                                <span class="badge bg-primary">#{{ $transfer->id }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="item-info">
                                                        <strong>{{ $transfer->item->type }}</strong>
                                                        <br>
                                                        <small class="text-muted">ID: {{ $transfer->item->id }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $transfer->fromWarehouse->name }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">{{ $transfer->toWarehouse->name }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $transfer->quantity }}</strong>
                                            </td>
                                            <td>
                                                <span class="transfer-date">{{ $transfer->transfer_date->format('M d, Y') }}</span>
                                            </td>
                                            <td>
                                                <span class="user-name">{{ $transfer->user->name }}</span>
                                            </td>
                                            <td>
                                                @if($transfer->notes)
                                                    <span class="notes-text" title="{{ $transfer->notes }}">
                                                        {{ Str::limit($transfer->notes, 30) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('transfers.show', $transfer) }}" class="btn btn-sm btn-outline-primary action-btn">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $transfers->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-exchange-alt empty-icon"></i>
                                <h5 class="empty-title">No Transfers Yet</h5>
                                <p class="empty-description">Start by creating your first transfer between warehouses.</p>
                                <a href="{{ route('transfers.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create First Transfer
                                </a>
                            </div>
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

    .create-transfer-btn {
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

    .create-transfer-btn:hover {
        background: #1a4b8c;
        box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        color: white;
        transform: translateY(-2px);
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

    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
    }

    .transfer-date {
        font-weight: 500;
        color: var(--dark);
    }

    .user-name {
        font-weight: 500;
        color: var(--primary);
    }

    .notes-text {
        font-size: 0.875rem;
        color: var(--dark-light);
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

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--light-gray);
        margin-bottom: 1rem;
    }

    .empty-title {
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .empty-description {
        color: var(--dark-light);
        margin-bottom: 2rem;
    }

    .header-left {
        flex: 1;
    }

    .header-right {
        margin-left: 2rem;
        display: flex;
        justify-content: flex-end;
    }
</style>
@endsection
