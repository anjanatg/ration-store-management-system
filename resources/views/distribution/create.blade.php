@extends('layouts.app')

@section('title', 'New Distribution')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>New Distribution</h2>
        <a href="{{ route('distribution.index') }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Step 1: Choose Customer</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('distribution.create') }}" method="GET">
                <select name="customer_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Select Customer</option>

                    @foreach ($customers as $item)
                        <option value="{{ $item->id }}"
                            {{ $customer && $customer->id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }} ({{ $item->ration_card_number }})
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    @if ($customer)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    Step 2: Give Ration to {{ $customer->name }}
                    ({{ $customer->cardCategory->name ?? '-' }})
                </h5>
            </div>
            <div class="card-body">
                <form id="distributionForm" novalidate>
                    @csrf
                    <div id="distributionAlert" class="alert alert-danger d-none"></div>
                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="distribution_date" class="form-control" value="{{ date('Y-m-d') }}">
                        <small class="text-danger" data-error="distribution_date"></small>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Monthly Limit</th>
                                    <th>Already Given</th>
                                    <th>Remaining</th>
                                    <th>Give Now</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($rows as $row)
                                    <tr>
                                        <td>{{ $row['product']->name }}</td>
                                        <td>{{ $row['monthly'] }} {{ $row['product']->unit }}</td>
                                        <td>{{ $row['given'] }} {{ $row['product']->unit }}</td>
                                        <td>{{ $row['remaining'] }} {{ $row['product']->unit }}</td>
                                        <td>
                                            <input type="number" step="0.01" min="0" name="quantities[{{ $row['product']->id }}]" class="form-control quantity" value="0" {{ $row['remaining'] <= 0 ? 'readonly' : '' }}>
                                            <small class="text-danger" data-error="quantities.{{ $row['product']->id }}"></small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            No monthly entitlement is set for this card category.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div id="distributionQuantityError" class="text-danger mb-2"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="2"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Distribution</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
    <script>
        const DISTRIBUTION_URL = "{{ route('distribution.store') }}";
    </script>
    <script src="{{ asset('assets/js/distribution-form.js') }}"></script>
@endpush