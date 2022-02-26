<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">E-shop</a>
      <div class="search-bar d-sm-none d-md-block">
        <form action="{{url('/search-product')}}" method="POST">@csrf
          <div class="input-group">
            <input name="search" required id="tags" type="search" class="form-control" placeholder="Search">
            <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto pe-4">
          <a class="nav-link {{Request::is('/')? "active" : ""}}" aria-current="page" href="{{url('/')}}">Home</a>
          <a class="nav-link" href="{{url('/categories')}}">Categories</a>
          @guest
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{-- <i class="fas fa-caret-down"></i> --}}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              
              @if (Route::has('login'))
                  <li>
                      <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
              @endif

              @if (Route::has('register'))
                  <li>
                      <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
            </ul>
          </li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{-- <i class="fas fa-caret-down"></i> --}}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @if (Auth::user()->is_admin)
                  <li><a class="dropdown-item" href="{{url('/dashboard')}}">Dashboard</a></li>
                @endif
                <li><a class="dropdown-item" href="{{url('/my-orders')}}">My orders</a></li>
                <li><a class="dropdown-item" href="#">My profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </li>
              </ul>
            </li>
            
          <a class="nav-link" href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> <span class="badge badge-pill bg-warning cart-count"></span></a>
          <a class="nav-link" href="{{url('/wishlist')}}"><i class="far fa-heart"></i> <span class="badge badge-pill bg-warning wishlist-count">0</span></a>
          @endif
        </div>
      </div>
    </div>
  </nav>