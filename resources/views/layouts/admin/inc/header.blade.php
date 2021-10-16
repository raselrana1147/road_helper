 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
           <i class="fas fa-user"></i>
         
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          <div class="dropdown-divider"></div>
         
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.profile.show') }}" class="dropdown-item">
            <!-- Message Start -->

            <div class="media">
              <img src="{{(Auth::user()->avatar !=null) ? asset('assets/backend/profile/'.Auth::user()->avatar) : asset('assets/backend/profile/default.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{Auth::user()->name}}
                </h3>
                <p class="text-sm">Update Profile</p>
              </div>
            </div>
            
            <!-- Message End -->
          </a>
          <a href="{{ route('admin.password') }}" class="dropdown-item">
          <div class="media">
            
            <div class="media-body" style="padding:8px">
                <p class="text-sm"><i class="fas fa-unlock-alt"></i> Change Password</p>
            </div>
            
          </div>
        </a>
          <div class="dropdown-divider"></div>
           <a class="dropdown-item dropdown-footer" href="#" role="button" onclick="event.preventDefault();
          document.getElementById('logout-form-admin').submit();"><i class="fas fa-sign-out-alt"></i> Sign out</a>
          <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        {{--    <a href="#" class="dropdown-item dropdown-footer">
          Logout</a> --}}
        </div>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>