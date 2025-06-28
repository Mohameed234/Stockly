@extends('layouts.app')

@section('title', 'Add New Item')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card edit-user-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="header-left">
                            <h5 class="mb-0">Add New Item</h5>
                            <p class="text-muted mb-0">Create a new inventory item</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('items.index') }}" class="btn btn-primary back-to-users-btn">
                                <i class="fas fa-arrow-left"></i> Back to Items
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="POST" class="edit-user-form">
                        @csrf
                        <div class="form-grid">
                            <div class="form-column">
                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="type">Type</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" class="form-control @error('type') is-invalid @enderror"
                                            id="type" name="type" value="{{ old('type') }}" required
                                            placeholder="Enter item type">
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="measurement">Measurement</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" class="form-control @error('measurement') is-invalid @enderror"
                                            id="measurement" name="measurement" value="{{ old('measurement') }}" required
                                            placeholder="Enter measurement">
                                        @error('measurement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="amount">Amount</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                            id="amount" name="amount" value="{{ old('amount') }}" required
                                            placeholder="Enter amount">
                                        @error('amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="qrcode">QR Code</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" class="form-control @error('qrcode') is-invalid @enderror"
                                            id="qrcode" name="qrcode" value="{{ old('qrcode') }}"
                                            placeholder="Enter QR code">
                                        @error('qrcode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="in_date">In Date</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="date" class="form-control @error('in_date') is-invalid @enderror"
                                            id="in_date" name="in_date" value="{{ old('in_date') }}" required>
                                        @error('in_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="expire_date">Expire Date</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="date" class="form-control @error('expire_date') is-invalid @enderror"
                                            id="expire_date" name="expire_date" value="{{ old('expire_date') }}" required>
                                        @error('expire_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-column">
                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="get_from">From</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" class="form-control @error('get_from') is-invalid @enderror"
                                            id="get_from" name="get_from" value="{{ old('get_from') }}" required
                                            placeholder="Enter source location">
                                        @error('get_from')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="get_to">To</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="text" class="form-control @error('get_to') is-invalid @enderror"
                                            id="get_to" name="get_to" value="{{ old('get_to') }}" required
                                            placeholder="Enter destination location">
                                        @error('get_to')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="get_out_date">Out Date</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="date" class="form-control @error('get_out_date') is-invalid @enderror"
                                            id="get_out_date" name="get_out_date" value="{{ old('get_out_date') }}"
                                            placeholder="Enter out date">
                                        @error('get_out_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="amount_get_in">Amount In</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="number" step="0.01" class="form-control @error('amount_get_in') is-invalid @enderror"
                                            id="amount_get_in" name="amount_get_in" value="{{ old('amount_get_in') }}"
                                            placeholder="Enter amount in">
                                        @error('amount_get_in')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-row">
                            <div class="form-label">
                                <label for="warehouse_id">Warehouse (Optional)</label>
                            </div>
                            <div class="form-input">
                                <select class="form-control @error('warehouse_id') is-invalid @enderror"
                                    id="warehouse_id" name="warehouse_id">
                                    <option value="">Select a warehouse (optional)</option>
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                            {{ $warehouse->name }} - {{ $warehouse->location }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('warehouse_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> -->

                        <div class="form-row">
                            <div class="form-label">
                                <label for="warehouses">Warehouses (Optional)</label>
                            </div>
                            <div class="form-input">
                                <div class="warehouses-selection">
                                    @if($warehouses->count() > 0)
                                        <div class="warehouses-grid">
                                            @foreach($warehouses as $warehouse)
                                                <div class="warehouse-checkbox">
                                                    <input type="checkbox"
                                                           id="warehouse_{{ $warehouse->id }}"
                                                           name="warehouses[]"
                                                           value="{{ $warehouse->id }}"
                                                           {{ in_array($warehouse->id, old('warehouses', [])) ? 'checked' : '' }}
                                                           class="form-check-input">
                                                    <label for="warehouse_{{ $warehouse->id }}" class="form-check-label">
                                                        {{ $warehouse->name }} - {{ $warehouse->location }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No warehouses available to assign</p>
                                    @endif
                                </div>
                                @error('warehouses')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('warehouses.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-primary update-btn">
                                <i class="fas fa-save"></i> Create Item
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

    .form-grid {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .form-column {
        flex: 1;
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

    .form-control {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
        border-radius: 1rem;
        border: 2px solid var(--light-gray);
        background: white;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus {
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

    .form-control.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
    }

    .warehouses-selection {
        border: 2px solid var(--light-gray);
        border-radius: 1rem;
        padding: 1rem;
        background: white;
        transition: all 0.3s ease;
    }

    .warehouses-selection:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(5, 127, 242, 0.1);
    }

    .warehouses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 0.75rem;
        max-height: 200px;
        overflow-y: auto;
    }

    .warehouse-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .warehouse-checkbox:hover {
        background: var(--light-gray);
    }

    @media (max-width: 768px) {
        .form-grid {
            flex-direction: column;
            gap: 1rem;
        }

        .form-row {
            flex-direction: column;
            gap: 0.5rem;
            align-items: stretch;
        }

        .form-label {
            flex: none;
            text-align: left;
        }

        .card-header {
            padding: 1.5rem;
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
    }
</style>
@endsection
