@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

  <div class="d-flex justify-content-between align-items-start">
    <div>
      <h2 class="fw-bold">Dashboard</h2>
      <p class="text-secondary">Overview of your ration store management system</p>
    </div>
    <span class="text-secondary"><i class="bi bi-calendar3"></i> {{ now()->format('l, d F Y') }}</span>
  </div>
  <div class="row g-3 mb-4"> 

    <div class="col-md-6 col-xl-3">
      <div class="stat-card blue">
        <i class="bi bi-people-fill stat-icon"></i>
        <div>
          <p>Total Customers</p>
          <h3>{{ $totalCustomers }}</h3>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="stat-card green">
        <i class="bi bi-box-seam stat-icon"></i>
        <div>
          <p>Total Products</p>
          <h3>{{ $totalProducts }}</h3>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="stat-card purple">
        <i class="bi bi-database-fill stat-icon"></i>
        <div>
          <p>Available Stock</p>
          @forelse ($stockByUnit as $stock)
            <div class="fw-bold">{{ number_format($stock->total_stock, 2) }} {{ $stock->unit }}</div>
          @empty
            <div class="fw-bold">0</div>
          @endforelse
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="stat-card orange">
        <i class="bi bi-truck stat-icon"></i>
        <div>
          <p>Monthly Distributions</p>
          <h3>{{ $monthlyDistributions }}</h3>
        </div>
        <small class="text-secondary w-100">In {{ now()->format('F Y') }}</small>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">

    <div class="col-lg-7">
      <div class="box">
        <h5 class="fw-bold mb-4">Monthly Distribution</h5>
        @php
          $maxTotal = max($monthlyChart->max('total'), 1);
        @endphp

        <div class="chart-bars">
          @foreach ($monthlyChart as $month)
            <div class="bar-wrap">
              <span class="bar-count">{{ $month['total'] }}</span>
              <div class="bar" style="height: {{ $month['total'] / $maxTotal * 100 }}%"></div>
              <small>{{ $month['label'] }}</small>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="box">
        <div class="d-flex justify-content-between mb-3">
          <h5 class="fw-bold"><i class="bi bi-exclamation-triangle-fill text-danger"></i> Low Stock Alerts</h5>
          <a href="{{ route('products.index') }}" class="text-decoration-none">View All</a>
        </div>
        <table class="table table-sm align-middle">
          <thead class="table-light">
            <tr><th>Product</th><th>Current Stock</th></tr>
          </thead>
          <tbody>
            @forelse ($lowStockProducts as $product)
              <tr>
                <td>{{ $product->name }}</td>
                <td class="text-danger">{{ (float) $product->available_stock }} {{ $product->unit }}</td>
              </tr>
            @empty
              <tr><td colspan="2" class="text-center text-secondary">No low stock products.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="row g-3">

    <div class="col-lg-12">
      <div class="box">
        <h5 class="fw-bold mb-3"><i class="bi bi-lightning-charge"></i> Quick Actions</h5>

        <div class="row g-3">
          <div class="col-6">
            <a href="{{ route('products.create') }}" class="action-card blue">
              <i class="bi bi-box-seam-fill"></i>
              <span>Add Product</span>
            </a>
          </div>
          <div class="col-6">
            <a href="{{ route('customers.index')}}" class="action-card green">
              <i class="bi bi-people-fill"></i>
              <span>Register Customer</span>
            </a>
          </div>
          <div class="col-6">
            <a href="{{ route('stock.index') }}" class="action-card purple">
              <i class="bi bi-database-fill"></i>
              <span>Stock Entry</span>
            </a>
          </div>
          <div class="col-6">
            <a href="{{ route('distribution.create') }}" class="action-card orange">
              <i class="bi bi-truck"></i>
              <span>New Distribution</span>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection