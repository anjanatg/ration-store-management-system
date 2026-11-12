@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<h2 class="fw-bold">Edit Product</h2>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('products.index') }}">Products</a>
        </li>
        <li class="breadcrumb-item active">Edit Product</li>
    </ol>
</nav>

<div class="box">
    <h5 class="fw-bold mb-4">
        <i class="bi bi-pencil-square text-primary"></i> Edit Product Details
    </h5>

    <form method="POST" id="productForm" novalidate>
        @csrf
        @method('PUT')

        <div id="productAlert" class="alert alert-danger d-none"></div>

        <div class="row g-3">

            <div class="col-md-6">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name"
                    class="form-control"
                    value="{{ $product->name }}"
                    placeholder="Enter product name">
            </div>

            <div class="col-md-6">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">Select Category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="unit" class="form-label">Unit</label>
                <select name="unit" id="unit" class="form-select">
                    <option value="">Select Unit</option>

                    <option value="kg" {{ $product->unit == 'kg' ? 'selected' : '' }}>
                        Kilogram (kg)
                    </option>

                    <option value="litre" {{ $product->unit == 'litre' ? 'selected' : '' }}>
                        Litre
                    </option>

                    <option value="packet" {{ $product->unit == 'packet' ? 'selected' : '' }}>
                        Packet
                    </option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="available_stock" class="form-label">Available Stock</label>
                <input type="number" name="available_stock" id="available_stock"
                    min="0" step="0.01"
                    class="form-control"
                    value="{{ $product->available_stock }}"
                    placeholder="Enter available stock">
            </div>

        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg"></i> Update Product
            </button>

            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>const PRODUCT_URL = "{{ route('products.update', $product->id) }}";</script>
<script src="{{ asset('assets/js/product-form.js') }}"></script>
@endpush