
@extends('layouts.app')

@section('title', 'Edit Monthly Entitlement')

@section('content')

<div class="container-fluid py-4">

    <h4 class="mb-4">Edit Monthly Entitlement</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <div id="entitlementAlert" class="alert alert-danger d-none"></div>

            <form id="entitlementForm" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Ration Card Category</label>

                    <select name="card_category_id" class="form-select">
                        <option value="">Select Category</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $monthlyEntitlement->card_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    <div class="text-danger small error-message" data-error="card_category_id"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product</label>

                    <select name="product_id" class="form-select">
                        <option value="">Select Product</option>

                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $monthlyEntitlement->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} ({{ $product->unit }})
                            </option>
                        @endforeach

                    </select>

                    <div class="text-danger small error-message" data-error="product_id"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Monthly Quantity</label>

                    <input type="number"
                           name="quantity"
                           class="form-control"
                           value="{{ $monthlyEntitlement->quantity }}"
                           min="0.01"
                           step="0.01">

                    <div class="text-danger small error-message" data-error="quantity"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price per Unit (₹)</label>

                    <input type="number"
                           name="price"
                           class="form-control"
                           value="{{ $monthlyEntitlement->price }}"
                           min="0"
                           step="0.01">

                    <div class="text-danger small error-message" data-error="price"></div>

                    <small class="text-muted">Enter 0 if the product is free.</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Entitlement
                </button>

                <a href="{{ route('entitlements.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>const ENTITLEMENT_URL = "{{ route('entitlements.update', $monthlyEntitlement->id) }}";</script>
    <script src="{{ asset('assets/js/entitlement-form.js') }}"></script>
@endpush
