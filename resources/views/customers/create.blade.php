 @extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <h3 class="mb-1">Add Customer</h3>
        <p class="text-muted mb-0">Register a new ration card customer</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Customer Details</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <div class="row g-3">


                    <div class="col-md-6">
                        <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter customer name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" maxlength="10" placeholder="Enter 10 digit phone number">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ration Card Number <span class="text-danger">*</span></label>
                        <input type="text" name="ration_card_number" class="form-control @error('ration_card_number') is-invalid @enderror" value="{{ old('ration_card_number') }}" maxlength="15" placeholder="Enter ration card number">
                        @error('ration_card_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label class="form-label">Ration Card Category <span class="text-danger">*</span></label>
                        <select name="card_category_id" class="form-select @error('card_category_id') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('card_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('card_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Enter customer address">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save Customer
                    </button>

                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection