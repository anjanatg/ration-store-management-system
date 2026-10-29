@extends('layouts.app')

@section('title', 'Products')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h2 class="fw-bold mb-0">Products</h2>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </nav>
    </div>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg"></i> Add Product
    </a>
  </div>
  <div class="box">
    <form action="{{ route('products.index') }}" method="GET" class="row g-2 mb-3">
      <div class="col-md-5">
        <input type="text" name="search" class="form-control"
               placeholder="Search by product name or category" value="{{ request('search') }}">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i> Search</button>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
      </div>
    </form>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Available Stock</th>
            <th>Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->category->name ?? 'N/A' }}</td>
              <td>{{ ucfirst($product->unit) }}</td>
              <td>₹{{ number_format((float) $product->price, 2) }}</td>
              <td>{{ $product->available_stock }} {{ $product->unit }}</td>
              <td>
                @if ($product->is_active)
                  <span class="badge bg-success-subtle text-success">Active</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary">Inactive</span>
                @endif
              </td>
              <td class="text-end">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary">
                  <i class="bi bi-pencil"></i> Edit
                </a>

                @if ($product->is_active)
                  <form action="{{ route('products.deactivate', $product->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to deactivate this product?');">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-slash-circle"></i> Deactivate
                    </button>
                  </form>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-secondary py-4">No products found.</td>
            </tr>
          @endforelse
        </tbody>

      </table>
    </div>
    @if (method_exists($products, 'links'))
      {{ $products->links() }}
    @endif
  </div>
  
@endsection