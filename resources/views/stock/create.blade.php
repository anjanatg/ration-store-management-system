
@extends('layouts.app')

@section('title', 'Manage Stock')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Stock</h2>

        <a href="{{ route('stock.index') }}" class="btn btn-secondary">
            Back to Stock
        </a>
    </div>


    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Stock Transaction</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('stock.store') }}" method="POST" id="stockForm" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="form-label">Product</label>

                    <select name="product_id" class="form-select" required>
                        <option value="">Select Product</option>

                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                                (Available: {{ $product->available_stock }} {{ $product->unit }})
                            </option>
                        @endforeach
                    </select>

                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Transaction Type</label>

                    <select name="transaction_type" id="transaction_type"
                            class="form-select" required>
                        <option value="">Select Type</option>
                        <option value="addition" {{ old('transaction_type') == 'addition' ? 'selected' : '' }}>
                            Addition (Stock In)
                        </option>
                        <option value="deduction" {{ old('transaction_type') == 'deduction' ? 'selected' : '' }}>
                            Deduction (Stock Out)
                        </option>
                    </select>

                    @error('transaction_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>

                    <input type="number" name="quantity" step="0.01"
                           min="0.01" class="form-control"
                           value="{{ old('quantity') }}" required>

                    @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" id="supplierField">
                    <label class="form-label">Supplier Name</label>

                    <input type="text" name="supplier_name"
                           class="form-control"
                           value="{{ old('supplier_name') }}"
                           placeholder="Enter supplier name">

                    @error('supplier_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Transaction Date</label>

                    <input type="date" name="transaction_date"
                           class="form-control"
                           value="{{ old('transaction_date', date('Y-m-d')) }}"
                           required>

                    @error('transaction_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>

                    <textarea name="notes" class="form-control"
                              rows="3">{{ old('notes') }}</textarea>

                    @error('notes')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Transaction
                </button>

                <a href="{{ route('stock.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/stock.js') }}"></script>
@endpush
