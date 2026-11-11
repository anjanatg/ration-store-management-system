@extends('layouts.app')

@section('title', 'Category Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Category Management</h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            Back to Products
        </a>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Add New Category</h5>
        </div>

        <div class="card-body">
            <div id="categoryAlert" class="alert alert-danger d-none"></div>
            <form id="categoryForm" method="POST">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-8 mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name">
                    </div>
                    <div class="col-md-4 mb-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                            Add Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Existing Categories</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="10%">#</th>
                        <th>Category Name</th>
                        <th width="20%">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <span class="badge bg-success">
                                    Active
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-3">
                                No categories added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection
@push('scripts')
    <script>const CATEGORY_URL = "{{ route('categories.store') }}";</script>
    <script src="{{ asset('assets/js/category-form.js') }}"></script>
@endpush