@extends('layouts.app')

@section('title', 'Distribution')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Ration Distribution</h2>

        <a href="{{ route('distribution.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Distribution
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Products Given</th>
                        <th>Operator</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($distributions as $distribution)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $distribution->distribution_date->format('d-m-Y') }}</td>
                            <td>{{ $distribution->customer->name }}</td>
                            <td>
                                @foreach ($distribution->items as $item)
                                    <div>{{ $item->product->name }}: {{ $item->quantity }} {{ $item->product->unit }}</div>
                                @endforeach
                            </td>
                            <td>{{ $distribution->operator->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No distributions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection