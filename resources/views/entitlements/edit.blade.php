@extends('layouts.app')

@section('title', 'Edit Monthly Entitlement')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">Edit Monthly Entitlement</h4>


    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('entitlements.update', $monthlyEntitlement->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Ration Card Category</label>

                    <select name="card_category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('card_category_id', $monthlyEntitlement->card_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('card_category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Product</label>

                    <select name="product_id" class="form-select" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ old('product_id', $monthlyEntitlement->product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} ({{ $product->unit }})
                            </option>
                        @endforeach
                    </select>

                    @error('product_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Monthly Quantity</label>

                    <input type="number"
                           name="quantity"
                           class="form-control"
                           value="{{ old('quantity', $monthlyEntitlement->quantity) }}"
                           min="0.01"
                           step="0.01"
                           required>

                    @error('quantity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Price per Unit (₹)</label>

                    <input type="number"
                           name="price"
                           class="form-control"
                           value="{{ old('price', $monthlyEntitlement->price) }}"
                           min="0"
                           step="0.01"
                           required>

                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

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