<div class="topbar d-flex align-items-center justify-content-between">
  <i class="bi bi-list fs-4"></i>

  <div class="d-flex align-items-center gap-4">
    <span class="position-relative">
      <form action="{{ route('logout') }}" method="POST" class="mb-0">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">Logout
        </button>
      </form>
    </span>
    <span><i class="bi bi-person-circle fs-3 text-primary"></i> Admin</span>
  </div>
</div>