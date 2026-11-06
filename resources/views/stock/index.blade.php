
@extends('layouts.app')

@section('title', 'Stock Management')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Stock Management</h2>

        <a href="{{ route('stock.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Stock
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Stock Movement History</h5>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Transaction Type</th>
                        <th>Supplier</th>
                        <th>Date</th>
                        <th>Notes</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($stocks as $stock)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $stock->product->name }}</td>

                            <td>
                                {{ $stock->quantity }}
                                {{ $stock->product->unit }}
                            </td>

                            <td>
                                @if ($stock->transaction_type === 'addition')
                                    <span class="badge bg-success">Addition</span>
                                @else
                                    <span class="badge bg-danger">Deduction</span>
                                @endif
                            </td>

                            <td>{{ $stock->supplier_name ?? '-' }}</td>

                            <td>
                                {{ $stock->transaction_date->format('d-m-Y') }}
                            </td>

                            <td>{{ $stock->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No stock movements found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection
