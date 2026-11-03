
@extends('layouts.app')

@section('title', 'Add Monthly Entitlement')

@section('content')
<div class="container-fluid">

    <h4 class="mb-4">Add Monthly Entitlement</h4>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('entitlements.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Ration Card Category</label>

                    <select name="card_category_id" class="form-select">
                        <option value="">Select Category</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('card_category_id') == $category->id ? 'selected' : '' }}>
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

                    <select name="product_id" class="form-select">
                        <option value="">Select Product</option>

                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ old('product_id') == $product->id ? 'selected' : '' }}>
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
                           value="{{ old('quantity') }}"
                           min="0.01"
                           step="0.01"
                           placeholder="Enter monthly quantity">

                    @error('quantity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Entitlement
                </button>

                <a href="{{ route('entitlements.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>
@endsection
