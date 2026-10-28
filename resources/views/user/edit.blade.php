@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

  <h2 class="fw-bold">Edit User</h2>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ url('/users') }}">Users</a></li>
      <li class="breadcrumb-item active">Edit User</li>
    </ol>
  </nav>

  <div class="box">
    <h5 class="fw-bold mb-4"><i class="bi bi-pencil-square text-primary"></i> Edit User Details</h5>

    <form  method="post">
      @csrf
      @method('PUT')

      <div class="row g-3">

        <div class="col-md-6">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" value="Suresh Kumar" required>
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" value="suresh@example.com" required>
        </div>

        <div class="col-md-6">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="text" id="phone" name="phone" class="form-control" value="9876543210" required>
        </div>

        <div class="col-md-6">
          <label for="role" class="form-label">Role</label>
          <select id="role" name="role" class="form-select" required>
            <option value="admin">Admin</option>
            <option value="operator" selected>Operator</option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="password" class="form-label">New Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Leave empty to keep the old password">
        </div>

        <div class="col-md-6">
          <label for="password_confirmation" class="form-label">Confirm New Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-enter new password">
        </div>

        <div class="col-md-6">
          <label class="form-label d-block">Status</label>
          <div class="form-check form-check-inline">
            <input type="radio" id="active" name="status" value="active" class="form-check-input" checked>
            <label for="active" class="form-check-label">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" id="inactive" name="status" value="inactive" class="form-check-input">
            <label for="inactive" class="form-check-label">Inactive</label>
          </div>
        </div>

        <div class="col-12">
          <label for="address" class="form-label">Address (optional)</label>
          <textarea id="address" name="address" rows="3" class="form-control">Kozhikode, Kerala</textarea>
        </div>

      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Update User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>

@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>const USER_URL = "{{ route('admin.users.update', $user->id) }}";</script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('js/user-form.js') }}"></script>
@endpush