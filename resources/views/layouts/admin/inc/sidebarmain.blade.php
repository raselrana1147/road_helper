 <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{(Auth::user()->avatar !=null) ? asset('backend/profile/'.Auth::user()->avatar) : asset('backend/profile/default.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('admin.dashboard') }}" class="d-block">{{Auth::user()->name}}</a>

        </div>
      </div>

      <!-- SidebarSearch Form -->
 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{(Request::routeIs('admin.dashboard')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              
              </p>
            </a>
        
          </li>

          <li class="nav-item">
            <a href="{{ route('all.blood.request') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Blood Request
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('all.users') }}" class="nav-link">
              <i class="fas fa-user"></i>
              <p>
                Users
              </p>
            </a>
          </li>
       
        
          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('division.index')) ? '' : ''}}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Divisions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('division.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disvision List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('division.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Division Create</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('district.index')) ? '' : ''}}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                District
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('district.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>District List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('district.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>District Create</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('police_station.index')) ? '' : ''}}">
             <i class="fab fa-artstation"></i>
              <p>
                Police Station
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('police_station.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Police Station List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('police_station.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Police Station Create</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('ambulance.index')) ? '' : ''}}">
             <i class="fas fa-ambulance"></i>
              <p>
                Ambulance
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ambulance.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ambulance List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ambulance.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ambulance Create</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('touring_place.index')) ? '' : ''}}">
              <i class="fab fa-watchman-monitoring"></i>
              <p>
                Touring Place
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('touring_place.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Touring Place List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('touring_place.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Touring Place Create</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('hotel.index')) ? '' : ''}}">
             <i class="fas fa-hotel"></i>
              <p>
                Hotel
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('hotel.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hotel List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('hotel.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hotel Create</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('blood_bank.index')) ? '' : ''}}">
              <i class="fas fa-university"></i>
              <p>
                Blood Bank
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('blood_bank.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blood Bank List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('blood_bank.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blood Create Create</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('notification.index')) ? '' : ''}}">
             <i class="fas fa-bell-slash"></i>
              <p>
                Notification
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('notification.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('notification.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notification Create</p>
                </a>
              </li>
            </ul>
          </li>

        

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>