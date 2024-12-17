<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <!-- Store link visible to all users -->
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('store') ? 'active' : '') }}" href="{{ route('store.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-store"></i>
          </div>
          <span class="nav-link-text ms-1">Store</span>
        </a>
      </li>

      <!-- Dashboard link visible to all users -->
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('dashboard') ? 'active' : '') }}" href="{{ url('dashboard') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <!-- SVG Icon -->
            </svg>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <!-- Cart link, visible only to authenticated users -->
      @auth
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('cart') ? 'active' : '') }}" href="{{ route('cart.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <span class="nav-link-text ms-1">Cart</span>
        </a>
      </li>
      @endauth

      <!-- Orders link, visible only to authenticated users -->
      @auth
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('orders') ? 'active' : '') }}" href="{{ route('orders.index') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-box"></i>
          </div>
          <span class="nav-link-text ms-1">Orders</span>
        </a>
      </li>
      @endauth

      <!-- Admin-only section, visible only to users with the admin role -->
      @if(auth()->user()->is_admin == true)
      <!-- Products Section -->
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('products/manage') ? 'active' : '') }}" href="{{ route('products.manage') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-cogs"></i>
          </div>
          <span class="nav-link-text ms-1">Manage Products</span>
        </a>
      </li>

      <!-- Orders Section -->
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('admin/orders') ? 'active' : '') }}" href="{{ route('admin.orders') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-box"></i>
          </div>
          <span class="nav-link-text ms-1">Manage Orders</span>
        </a>
      </li>

      <!-- Make New Admin Account Section -->
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('admin/create-admin') ? 'active' : '') }}" href="{{ route('admin.create-admin') }}">
          <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-plus"></i>
          </div>
          <span class="nav-link-text ms-1">Make New Admin</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</aside>
