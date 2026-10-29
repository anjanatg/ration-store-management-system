@extends('layouts.app')

@section('title', 'Add Staff')

@section('content')

  <h2 class="fw-bold">Add Staff</h2>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Stafflist</a></li>
      <li class="breadcrumb-item active">Add Staff</li>
    </ol>
  </nav>

  <div class="box">
    <h5 class="fw-bold mb-4"><i class="bi bi-person-plus-fill text-primary"></i> Staff Details</h5>

    <form id="userForm" data-mode="add" action="{{ route('admin.users.store') }}" method="post" novalidate>
      @csrf
      <div id="userAlert" class="alert alert-danger d-none"></div>

      <div class="row g-3">

        <div class="col-md-6">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" placeholder="Enter full name">
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address">
        </div>

        <div class="col-md-6">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter 10 digit phone number" maxlength="10">
        </div>

        <div class="col-md-3">
          <label for="age" class="form-label">Age</label>
          <input type="number" id="age" name="age" class="form-control" placeholder="Age">
        </div>

        <div class="col-md-3">
          <label for="date_of_birth" class="form-label">Date of Birth</label>
          <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" max="{{ now()->toDateString() }}">
        </div>

        <div class="col-md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter password">
        </div>

        <div class="col-md-6">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-enter password">
        </div>

        <div class="col-md-6">
          <label class="form-label d-block">Gender</label>
          <div class="form-check form-check-inline">
            <input type="radio" id="male" name="gender" value="male" class="form-check-input">
            <label for="male" class="form-check-label">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" id="female" name="gender" value="female" class="form-check-input">
            <label for="female" class="form-check-label">Female</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" id="other" name="gender" value="other" class="form-check-input">
            <label for="other" class="form-check-label">Other</label>
          </div>
          <div id="gender-error"></div>
        </div>

        <div class="col-12">
          <label for="address" class="form-label">Address (optional)</label>
          <textarea id="address" name="address" rows="3" class="form-control" placeholder="Enter address"></textarea>
        </div>

      </div>

      <div class="mt-4">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Save User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>

@endsection

@push('scripts')

    <script>const USER_URL = "{{ route('admin.users.store') }}";</script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="{{ asset('assets/js/user-form.js') }}"></script>
@endpush