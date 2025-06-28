@extends('layouts.app')

@section('title', 'Edit Warehouse')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card edit-user-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="header-left">
                            <h5 class="mb-0">Edit Warehouse</h5>
                            <p class="text-muted mb-0">Update warehouse information</p>
                        </div>
                        <div class="header-right">
                            <a href="{{ route('warehouses.index') }}" class="btn btn-primary back-to-warehouses-btn">
                                <i class="fas fa-arrow-left"></i> Back to Warehouses
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('warehouses.update', $warehouse) }}" method="POST" class="edit-user-form">
                        @csrf
                        @method('PUT')
                        <div class="form-rows">
                            <div class="form-row">
                                <div class="form-label">
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-input">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $warehouse->name) }}" required
                                        placeholder="Enter warehouse name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">
                                    <label for="location">Location</label>
                                </div>
                                <div class="form-input">
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location', $warehouse->location) }}" required
                                        placeholder="Enter warehouse location">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-label">
                                    <label for="items">Items (Optional)</label>
                                </div>
                                <div class="form-input">
                                    <div class="items-selection">
                                        @if($items->count() > 0)
                                            <div class="items-grid">
                                                @foreach($items as $item)
                                                    <div class="item-checkbox">
                                                        <input type="checkbox"
                                                               id="item_{{ $item->id }}"
                                                               name="items[]"
                                                               value="{{ $item->id }}"
                                                               {{ in_array($item->id, old('items', $warehouse->items->pluck('id')->toArray())) ? 'checked' : '' }}
                                                               class="form-check-input">
                                                        <label for="item_{{ $item->id }}" class="form-check-label">
                                                            {{ $item->type }} - {{ $item->measurement }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted">No items available to assign</p>
                                        @endif
                                    </div>
                                    @error('items')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @error('items.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button type="submit" class="btn btn-primary update-btn">
                                <i class="fas fa-save"></i> Update Warehouse
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
        cursor: pointer;
    }

    .back-to-warehouses-btn:hover {
        background: #1a4b8c;
        box-shadow: 0 4px 15px rgba(5, 127, 242, 0.2);
        color: white;
    }

    .back-to-warehouses-btn:active {
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

    .items-selection {
        border: 2px solid var(--light-gray);
        border-radius: 1rem;
        padding: 1rem;
        background: white;
        transition: all 0.3s ease;
    }

    .items-selection:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(5, 127, 242, 0.1);
    }

    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 0.75rem;
        max-height: 200px;
        overflow-y: auto;
    }

    .item-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .item-checkbox:hover {
        background: var(--light-gray);
    }

    .form-check-input {
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid var(--light-gray);
        border-radius: 0.25rem;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .form-check-label {
        font-size: 0.9rem;
        color: var(--dark);
        cursor: pointer;
        margin: 0;
    }

    @media (max-width: 768px) {
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

        .back-to-warehouses-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
