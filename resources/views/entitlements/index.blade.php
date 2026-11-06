@extends('layouts.app')

@section('title', 'Monthly Entitlements')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Monthly Entitlements</h4>

        <a href="{{ route('entitlements.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Entitlement
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Card Category</th>
                        <th>Product</th>
                        <th>Monthly Quantity</th>
                        <th>Price per Unit</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($entitlements as $entitlement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $entitlement->cardCategory->name }}
                            </td>

                            <td>
                                {{ $entitlement->product->name }}
                            </td>

                            <td>
                                {{ $entitlement->quantity }}
                                {{ $entitlement->product->unit }}
                            </td>

                            <td>
                                @if($entitlement->price == 0)
                                    <span class="badge bg-success">Free</span>
                                @else
                                    ₹{{ number_format($entitlement->price, 2) }}
                                    / {{ $entitlement->product->unit }}
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('entitlements.edit', $entitlement->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('entitlements.destroy', $entitlement->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this entitlement?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No monthly entitlements found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection