@extends('layouts.app')

@section('title', 'Edit Monthly Entitlement')

@section('content')
<div class="container mt-4">

    <h3>Edit Monthly Entitlement</h3>

    <form action="{{ route('entitlements.update', $monthlyEntitlement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Card Category</label>
            <select name="card_category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $monthlyEntitlement->card_category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Product</label>
            <select name="product_id" class="form-select" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}"
                        {{ $monthlyEntitlement->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Monthly Quantity</label>
            <input type="number" name="quantity" step="0.01"
                value="{{ $monthlyEntitlement->quantity }}"
                class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('entitlements.index') }}" class="btn btn-secondary">Cancel</a>

    </form>
</div>
@endsection