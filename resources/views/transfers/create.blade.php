@extends('layouts.app')

@section('title', 'Create Transfer')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card edit-user-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="header-left">
                            <h5 class="mb-0">Create New Transfer</h5>
                            <p class="text-muted mb-0">Transfer items between warehouses</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('transfers.index') }}" class="btn btn-primary back-to-users-btn">
                                <i class="fas fa-arrow-left"></i> Back to Transfers
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('transfers.store') }}" method="POST" class="edit-user-form" id="transferForm">
                        @csrf

                        <div class="form-grid">
                            <div class="form-column">
                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="from_warehouse_id">Source Warehouse</label>
                                    </div>
                                    <div class="form-input">
                                        <select class="form-control @error('from_warehouse_id') is-invalid @enderror"
                                                id="from_warehouse_id"
                                                name="from_warehouse_id"
                                                required>
                                            <option value="">Select Source Warehouse</option>
                                            @foreach($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}"
                                                        {{ old('from_warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                                    {{ $warehouse->name }} ({{ $warehouse->location }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('from_warehouse_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="to_warehouse_id">Destination Warehouse</label>
                                    </div>
                                    <div class="form-input">
                                        <select class="form-control @error('to_warehouse_id') is-invalid @enderror"
                                                id="to_warehouse_id"
                                                name="to_warehouse_id"
                                                required>
                                            <option value="">Select Destination Warehouse</option>
                                            @foreach($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}"
                                                        {{ old('to_warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                                    {{ $warehouse->name }} ({{ $warehouse->location }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('to_warehouse_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="item_id">Select Item</label>
                                    </div>
                                    <div class="form-input">
                                        <select class="form-control @error('item_id') is-invalid @enderror"
                                                id="item_id"
                                                name="item_id"
                                                required
                                                disabled>
                                            <option value="">First select a source warehouse</option>
                                        </select>
                                        @error('item_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text">Only items available in the source warehouse will be shown.</small>
                                        <div id="loading-indicator" class="loading-spinner" style="display: none;">
                                            <i class="fas fa-spinner fa-spin"></i> Loading items...
                                        </div>
                                        <div id="items-count" class="items-count" style="display: none;">
                                            <small class="text-success">
                                                <i class="fas fa-check-circle"></i>
                                                <span id="items-count-text"></span> items available
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-column">
                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="quantity">Quantity</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="number"
                                               class="form-control @error('quantity') is-invalid @enderror"
                                               id="quantity"
                                               name="quantity"
                                               min="1"
                                               value="{{ old('quantity', 1) }}"
                                               required>
                                        @error('quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text">Available quantity: <span id="available-quantity">-</span></small>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="transfer_date">Transfer Date</label>
                                    </div>
                                    <div class="form-input">
                                        <input type="date"
                                               class="form-control @error('transfer_date') is-invalid @enderror"
                                               id="transfer_date"
                                               name="transfer_date"
                                               value="{{ old('transfer_date', date('Y-m-d')) }}"
                                               required>
                                        @error('transfer_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-label">
                                        <label for="notes">Notes (Optional)</label>
                                    </div>
                                    <div class="form-input">
                                        <textarea class="form-control @error('notes') is-invalid @enderror"
                                                  id="notes"
                                                  name="notes"
                                                  rows="3"
                                                  placeholder="Add any additional notes about this transfer...">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-primary update-btn">
                                <i class="fas fa-exchange-alt"></i> Create Transfer
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

    .form-control.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }

    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
    }

    .form-text {
        font-size: 0.75rem;
        color: var(--dark-light);
        margin-top: 0.25rem;
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

    .alert {
        border: none;
        border-radius: 0.75rem;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
    }

    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .alert-success {
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
    }

    .loading-spinner {
        margin-top: 0.5rem;
        color: var(--primary);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .loading-spinner i {
        font-size: 1rem;
    }

    .items-count {
        margin-top: 0.5rem;
        font-size: 0.875rem;
    }

    .items-count small {
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

        .card-body {
            padding: 1.5rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fromWarehouseSelect = document.getElementById('from_warehouse_id');
    const toWarehouseSelect = document.getElementById('to_warehouse_id');
    const itemSelect = document.getElementById('item_id');
    const quantityInput = document.getElementById('quantity');
    const availableQuantitySpan = document.getElementById('available-quantity');
    const loadingIndicator = document.getElementById('loading-indicator');
    const itemsCount = document.getElementById('items-count');
    const itemsCountText = document.getElementById('items-count-text');

    console.log('Transfer form initialized');

    // Load items when source warehouse is selected
    fromWarehouseSelect.addEventListener('change', function() {
        const warehouseId = this.value;
        const warehouseName = this.options[this.selectedIndex].text;
        console.log('Source warehouse changed to:', warehouseId, '(', warehouseName, ')');

        if (warehouseId) {
            // Enable item selection
            itemSelect.disabled = false;
            itemSelect.innerHTML = '<option value="">Loading items...</option>';
            availableQuantitySpan.textContent = '-';
            loadingIndicator.style.display = 'flex';
            itemsCount.style.display = 'none';

            // Fetch items from the selected warehouse
            const url = `/transfers/items-by-warehouse?warehouse_id=${warehouseId}`;
            console.log('Fetching items from:', url);

            fetch(url)
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);

                    // Check if data is an array (items) or has an error
                    if (Array.isArray(data)) {
                        const items = data;
                        loadingIndicator.style.display = 'none';
                        itemSelect.innerHTML = '<option value="">-- Select an item --</option>';

                        if (items.length === 0) {
                            itemSelect.innerHTML = '<option value="">No items available in this warehouse</option>';
                            itemsCount.style.display = 'none';
                            console.log('No items found in warehouse');
                            return;
                        }

                        items.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = `${item.type} (${item.amount} ${item.measurement})`;
                            option.dataset.amount = item.amount;
                            option.dataset.measurement = item.measurement;
                            itemSelect.appendChild(option);
                        });

                        // Show items count
                        itemsCountText.textContent = items.length;
                        itemsCount.style.display = 'block';

                        console.log(`Successfully loaded ${items.length} items from warehouse`);
                    } else if (data.error) {
                        throw new Error(data.error);
                    } else {
                        throw new Error('Invalid response format');
                    }
                })
                .catch(error => {
                    console.error('Error loading items:', error);
                    loadingIndicator.style.display = 'none';
                    itemSelect.innerHTML = '<option value="">Error loading items</option>';
                    itemsCount.style.display = 'none';

                    // Show error message to user
                    alert('Error loading items: ' + error.message);
                });
        } else {
            itemSelect.disabled = true;
            itemSelect.innerHTML = '<option value="">First select a source warehouse</option>';
            availableQuantitySpan.textContent = '-';
            loadingIndicator.style.display = 'none';
            itemsCount.style.display = 'none';
        }
    });

    // Update available quantity when item is selected
    itemSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const availableAmount = selectedOption.dataset.amount;

        console.log('Item selected, available amount:', availableAmount);

        if (availableAmount) {
            availableQuantitySpan.textContent = availableAmount;
            quantityInput.max = availableAmount;
            quantityInput.value = Math.min(quantityInput.value, availableAmount);
        } else {
            availableQuantitySpan.textContent = '-';
        }
    });

    // Validate that source and destination warehouses are different
    document.getElementById('transferForm').addEventListener('submit', function(e) {
        const fromWarehouse = fromWarehouseSelect.value;
        const toWarehouse = toWarehouseSelect.value;

        if (fromWarehouse && toWarehouse && fromWarehouse === toWarehouse) {
            e.preventDefault();
            alert('Source and destination warehouses must be different.');
            return false;
        }
    });

    // Add change event for destination warehouse to prevent same warehouse selection
    toWarehouseSelect.addEventListener('change', function() {
        const fromWarehouse = fromWarehouseSelect.value;
        const toWarehouse = this.value;

        if (fromWarehouse && toWarehouse && fromWarehouse === toWarehouse) {
            alert('Source and destination warehouses must be different.');
            this.value = '';
        }
    });
});
</script>
@endsection
