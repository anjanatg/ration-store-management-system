@extends('layouts.app')

@section('title', 'Edit Staff')

@section('content')

  <h2 class="fw-bold">Edit Staff</h2>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
      <li class="breadcrumb-item active">Edit Staff</li>
    </ol>
  </nav>

  <div class="box">
    <h5 class="fw-bold mb-4"><i class="bi bi-pencil-square text-primary"></i> Edit User Details</h5>

    <form id="userForm" method="post" data-mode="edit" novalidate>
      @csrf
      @method('PUT')

      <div class="row g-3">

        <div class="col-md-6">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="col-md-6">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="text" id="phone" name="phone" class="form-control" value="{{ $user->phone }}" required>
        </div>

        <div class="col-md-3">
          <label for="age" class="form-label">Age</label>
          <input type="number" id="age" name="age" class="form-control" placeholder="Age" value="{{ $user->age }}">
        </div>

        <div class="col-md-3">
          <label for="date_of_birth" class="form-label">Date of Birth</label>
          <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" max="{{ now()->toDateString() }}" value="{{ $user->date_of_birth }}">
        </div>

        <div class="mb-3">
          <label class="form-label d-block">Gender</label>
          <div class="form-check form-check-inline">
            <input type="radio" name="gender" id="male" value="male" class="form-check-input"
            @if ($user->gender == 'male') checked @endif>
            <label for="male" class="form-check-label">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="gender" id="female" value="female" class="form-check-input"
            @if ($user->gender == 'female') checked @endif>
            <label for="female" class="form-check-label">Female</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="gender" id="other" value="other" class="form-check-input"
            @if ($user->gender == 'other') checked @endif>
            <label for="other" class="form-check-label">Other</label>
          </div>
          <div id="gender-error"></div>
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
            <input type="radio" id="active" name="is_active" value="1" class="form-check-input" {{ $user->is_active ? 'checked' : '' }}>
            <label for="active" class="form-check-label">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" id="inactive" name="is_active" value="0" class="form-check-input" {{ !$user->is_active ? 'checked' : '' }}>
            <label for="inactive" class="form-check-label">Inactive</label>
          </div>
        </div>

        <div class="col-12">
          <label for="address" class="form-label">Address (optional)</label>
          <textarea id="address" name="address" rows="3" class="form-control">{{ $user->address }}</textarea>
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
    <script src="{{ asset('assets/js/user-form.js') }}"></script>
@endpush