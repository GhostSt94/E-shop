<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <div class="navbar-brand m-0">
        <img src="{{asset('admin/img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Dashboard</span>
      </div>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('dashboard')? 'active':''}}" href="{{url('dashboard')}}">
            
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('dashboard/categories')||Request::is('dashboard/categories/*')? 'active':''}}" href="{{url('dashboard/categories')}}">
            <span class="nav-link-text ms-1">Catégories</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('dashboard/products')||Request::is('dashboard/products/*')? 'active':''}}" href="{{url('dashboard/products')}}">
            <span class="nav-link-text ms-1">Products</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('dashboard/orders')||Request::is('dashboard/orders/*')? 'active':''}}" href="{{url('dashboard/orders')}}">
            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{Request::is('dashboard/users')? 'active':''}}" href="{{url('dashboard/users')}}">
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link text-white " href="../pages/billing.html">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
          </a>
        </li> --}}
      </ul>
    </div>
  </aside>