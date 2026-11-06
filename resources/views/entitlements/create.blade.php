@extends('layouts.app')

@section('title', 'Add Monthly Entitlement')

@section('content')

  <h2 class="fw-bold mb-3">Add Monthly Entitlement</h2>

  <div class="box">
    <form id="entitlementForm" novalidate>
      @csrf
      <div id="entitlementAlert" class="alert alert-danger d-none"></div>

      <div class="mb-3">
        <label for="card_category_id" class="form-label">Ration Card Category</label>
        <select id="card_category_id" name="card_category_id" class="form-select">
          <option value="">Select Category</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach 
        </select>
      </div>

      <div class="mb-3">
        <label for="product_id" class="form-label">Product</label>
        <select id="product_id" name="product_id" class="form-select">
          <option value="">Select Product</option>
          @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="monthly_quantity" class="form-label">Monthly Quantity</label>
        <input type="number" id="monthly_quantity" name="monthly_quantity" class="form-control" placeholder="Enter monthly quantity">
      </div>

      <div class="mb-3">
        <label for="price_per_unit" class="form-label">Price per Unit (₹)</label>
        <input type="number" id="price_per_unit" name="price_per_unit" class="form-control" value="0">
        <div class="form-text">Enter 0 if the product is free.</div>
      </div>

      <button type="submit" class="btn btn-primary">Save Entitlement</button>
      <a href="{{ route('entitlements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>

@endsection

@push('scripts')
  <script>const ENTITLEMENT_URL = "{{ route('entitlements.store') }}";</script>
  <script src="{{ asset('assets/js/entitlement-form.js') }}"></script>
@endpush