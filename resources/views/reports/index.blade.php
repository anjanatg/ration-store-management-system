@extends('layouts.app')

@section('title', 'Distribution Reports')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Distribution Reports</h4>

        <a href="{{ route('reports.export', request()->query()) }}" class="btn btn-success">
            <i class="bi bi-download"></i> Export CSV
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h6 class="mb-0">Filter Reports</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('reports.index') }}" method="GET">
                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Customer</label>
                        <select name="customer_id" class="form-select">
                            <option value="">All Customers</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" @selected(request('customer_id') == $customer->id)>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Product</label>
                        <select name="product_id" class="form-select">
                            <option value="">All Products</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" @selected(request('product_id') == $product->id)>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Ration Card Category</label>
                        <select name="card_category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach ($cardCategories as $category)
                                <option value="{{ $category->id }}" @selected(request('card_category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Filter
                        </button>
                        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reset</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0">Distribution Details</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Ration Card</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Operator</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($reports as $report)
                            @foreach ($report->items as $item)
                                <tr>
                                    <td>{{ $report->distribution_date->format('d-m-Y') }}</td>
                                    <td>{{ $report->customer->name }}</td>
                                    <td>{{ $report->customer->ration_card_number }}</td>
                                    <td>{{ $report->customer->cardCategory->name }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }} {{ $item->product->unit }}</td>
                                    <td>{{ $report->operator->name }}</td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    No distribution records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection