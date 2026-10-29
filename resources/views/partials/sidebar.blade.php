<div class="sidebar" id="sidebar">
  <div class="brand">
    <i class="bi bi-basket2-fill brand-icon"></i>
    <div>
      <h5 class="mb-0">Ration Store</h5>
      <small>Management System</small>
    </div>
    <button type="button" id="sidebarClose" class="btn-close btn-close-white ms-auto d-lg-none"></button>
  </div>

  <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
    <i class="bi bi-house-door-fill"></i> Dashboard
  </a>

  <p class="menu-title">User Management</p>
  <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
    <i class="bi bi-person-fill"></i> Users <i class="bi bi-chevron-right ms-auto"></i>
  </a>

  <p class="menu-title">Product Management</p>
  <a href="{{ route('products.index') }}" class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
    <i class="bi bi-box-seam-fill"></i> Products <i class="bi bi-chevron-right ms-auto"></i>
  </a>

  <p class="menu-title">Customer Management</p>
  <a href="#" class="menu-item">
    <i class="bi bi-people-fill"></i> Customers <i class="bi bi-chevron-right ms-auto"></i>
  </a>

  <p class="menu-title">Stock Management</p>
  <a href="#" class="menu-item">
    <i class="bi bi-cart-fill"></i> Stock <i class="bi bi-chevron-right ms-auto"></i>
  </a>

  <p class="menu-title">Ration Distribution</p>
  <a href="#" class="menu-item">
    <i class="bi bi-truck"></i> Distribution <i class="bi bi-chevron-right ms-auto"></i>
  </a>
  <a href="{{ route('categories.index') }}" class="menu-item">
    <i class="bi bi-tags"></i>
    <span>Categories</span>
  </a>
  <p class="menu-title">Reports</p>
  <a href="#" class="menu-item">
    <i class="bi bi-file-earmark-text-fill"></i> Reports <i class="bi bi-chevron-right ms-auto"></i>
  </a>

  <div class="sidebar-footer">
    Ration Store Management System<br>v1.0
  </div>
</div>