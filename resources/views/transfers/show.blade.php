@extends('layouts.app')

@section('title', 'Transfer Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="header-left">
                            <h5 class="mb-0">Transfer Details</h5>
                            <p class="text-muted mb-0">Transfer #{{ $transfer->id }}</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('transfers.index') }}" class="btn btn-outline-secondary back-btn">
                                <i class="fas fa-arrow-left"></i> Back to Transfers
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="transfer-info">
                        <!-- Transfer Header -->
                        <div class="transfer-header mb-4">
                            <div class="transfer-id">
                                <span class="badge bg-primary">Transfer #{{ $transfer->id }}</span>
                            </div>
                            <div class="transfer-status">
                                <span class="badge bg-success">Completed</span>
                            </div>
                        </div>

                        <!-- Transfer Flow -->
                        <div class="transfer-flow mb-4">
                            <div class="flow-container">
                                <div class="flow-step">
                                    <div class="step-icon">
                                        <i class="fas fa-warehouse"></i>
                                    </div>
                                    <div class="step-content">
                                        <h6 class="step-title">From</h6>
                                        <p class="step-detail">{{ $transfer->fromWarehouse->name }}</p>
                                        <small class="step-location">{{ $transfer->fromWarehouse->location }}</small>
                                    </div>
                                </div>

                                <div class="flow-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>

                                <div class="flow-step">
                                    <div class="step-icon">
                                        <i class="fas fa-warehouse"></i>
                                    </div>
                                    <div class="step-content">
                                        <h6 class="step-title">To</h6>
                                        <p class="step-detail">{{ $transfer->toWarehouse->name }}</p>
                                        <small class="step-location">{{ $transfer->toWarehouse->location }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item Details -->
                        <div class="item-details mb-4">
                            <h6 class="section-title">
                                <i class="fas fa-box"></i> Item Information
                            </h6>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Item Type:</span>
                                    <span class="detail-value">{{ $transfer->item->type }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Item ID:</span>
                                    <span class="detail-value">#{{ $transfer->item->id }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Quantity Transferred:</span>
                                    <span class="detail-value">{{ $transfer->quantity }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Measurement:</span>
                                    <span class="detail-value">{{ $transfer->item->measurement }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Transfer Details -->
                        <div class="transfer-details mb-4">
                            <h6 class="section-title">
                                <i class="fas fa-info-circle"></i> Transfer Information
                            </h6>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Transfer Date:</span>
                                    <span class="detail-value">{{ $transfer->transfer_date->format('F d, Y') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Transferred By:</span>
                                    <span class="detail-value">{{ $transfer->user->name }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Created At:</span>
                                    <span class="detail-value">{{ $transfer->created_at->format('F d, Y \a\t g:i A') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Last Updated:</span>
                                    <span class="detail-value">{{ $transfer->updated_at->format('F d, Y \a\t g:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($transfer->notes)
                        <div class="notes-section mb-4">
                            <h6 class="section-title">
                                <i class="fas fa-sticky-note"></i> Notes
                            </h6>
                            <div class="notes-content">
                                <p class="notes-text">{{ $transfer->notes }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Actions -->
                        <div class="actions-section">
                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('transfers.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-list"></i> View All Transfers
                                </a>
                                <a href="{{ route('transfers.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create New Transfer
                                </a>
                            </div>
                        </div>
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

    .back-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 1rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        transform: translateY(-2px);
    }

    .transfer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: var(--light-gray);
        border-radius: 0.75rem;
    }

    .badge {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
    }

    .transfer-flow {
        background: white;
        border: 2px solid var(--light-gray);
        border-radius: 1rem;
        padding: 2rem;
    }

    .flow-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .flow-step {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex: 1;
    }

    .step-icon {
        width: 60px;
        height: 60px;
        background: var(--primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .step-content {
        flex: 1;
    }

    .step-title {
        margin: 0;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--dark-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .step-detail {
        margin: 0.25rem 0;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--dark);
    }

    .step-location {
        color: var(--dark-light);
        font-size: 0.875rem;
    }

    .flow-arrow {
        padding: 0 2rem;
        color: var(--primary);
        font-size: 1.5rem;
    }

    .section-title {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: var(--primary);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        background: var(--light-gray);
        padding: 1.5rem;
        border-radius: 0.75rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .detail-label {
        font-weight: 500;
        color: var(--dark-light);
        font-size: 0.875rem;
    }

    .detail-value {
        font-weight: 600;
        color: var(--dark);
        font-size: 0.875rem;
    }

    .notes-section {
        background: var(--light-gray);
        padding: 1.5rem;
        border-radius: 0.75rem;
    }

    .notes-content {
        background: white;
        padding: 1rem;
        border-radius: 0.5rem;
        border-left: 4px solid var(--primary);
    }

    .notes-text {
        margin: 0;
        color: var(--dark);
        line-height: 1.6;
    }

    .actions-section {
        padding-top: 2rem;
        border-top: 1px solid var(--light-gray);
    }

    .header-left {
        flex: 1;
    }

    .header-right {
        margin-left: 2rem;
        display: flex;
        justify-content: flex-end;
    }

    @media (max-width: 768px) {
        .flow-container {
            flex-direction: column;
            gap: 1rem;
        }

        .flow-arrow {
            transform: rotate(90deg);
            padding: 1rem 0;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .transfer-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }
</style>
@endsection
