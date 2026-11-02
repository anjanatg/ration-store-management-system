 @extends('layouts.app')

@section('title', 'Customer Management')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Customer Management</h3>
            <p class="text-muted mb-0">Manage ration card customers</p>
        </div>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Add Customer
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('customers.index') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control" placeholder="Search by name, phone or ration card number" value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-dark">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Customer List</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Ration Card Number</th>
                            <th>Category</th>
                            <th>Address</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->ration_card_number }}</td>
                                <td>
                                    {{ $customer->cardCategory->name ?? 'N/A' }}
                                </td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this customer?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No customers found.
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