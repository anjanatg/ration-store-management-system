<div class="sidebar" id="sidebar">
    <div class="brand">
        <i class="bi bi-basket2-fill brand-icon"></i>
        <div>
            <h5 class="mb-0">Ration Store</h5>
            <small>Management System</small>
        </div>
        <button type="button" id="sidebarClose" class="btn-close btn-close-white ms-auto d-lg-none">
        </button>
    </div>

    <a href="{{ route('dashboard') }}"
       class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door-fill"></i>
        Dashboard
    </a>

    @if(auth()->user()->role === 'admin')
        <p class="menu-title">Staff Management</p>
        <a href="{{ route('admin.users.index') }}"
           class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            Staff
            <i class="bi bi-chevron-right ms-auto"></i>
        </a>

        <p class="menu-title">Product Management</p>
        <a href="{{ route('products.index') }}"
           class="menu-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam-fill"></i>
            Products
            <i class="bi bi-chevron-right ms-auto"></i>
        </a>

        <a href="{{ route('categories.index') }}"
           class="menu-item {{ request()->routeIs('categories.index', 'categories.store') ? 'active' : '' }}">
            <i class="bi bi-tags"></i>
            Product Categories
        </a>

        <a href="{{ route('entitlements.index') }}"
           class="menu-item {{ request()->routeIs('entitlements.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i>
            Monthly Entitlements
        </a>
    @endif

    @if(in_array(auth()->user()->role, ['admin', 'staff']))
        <p class="menu-title">Customer Management</p>
        <a href="{{ route('customers.index') }}"
           class="menu-item {{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            Customers
            <i class="bi bi-chevron-right ms-auto"></i>
        </a>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('card-categories.index') }}"
               class="menu-item {{ request()->routeIs('card-categories.*') ? 'active' : '' }}">
                <i class="bi bi-card-list"></i>
                Ration Card Categories
            </a>

            <p class="menu-title">Stock Management</p>
            <a href="{{ route('stock.index') }}"
               class="menu-item {{ request()->routeIs('stock.*') ? 'active' : '' }}">
                <i class="bi bi-cart-fill"></i>
                Stock
            </a>
        @endif

        <p class="menu-title">Ration Distribution</p>
        <a href="{{ route('distribution.index') }}"
           class="menu-item {{ request()->routeIs('distribution.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i>
            Distribution
        </a>

        <p class="menu-title">Reports</p>
        <a href="{{ route('reports.index') }}"
           class="menu-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text-fill"></i>
            Reports
        </a>
    @endif

    <div class="sidebar-footer">
        Ration Store Management System<br>
        v1.0
    </div>
</div>