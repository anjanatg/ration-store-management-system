<div class="topbar d-flex align-items-center justify-content-between">
    <button type="button" id="sidebarToggle" class="btn border-0">
        <i class="bi bi-list fs-4"></i>
    </button>
    <div class="d-flex align-items-center gap-4">
        <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>
                Logout
            </button>
        </form>
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-circle fs-3 text-primary"></i>
            <div>
                <div class="fw-semibold">
                    {{ auth()->user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>