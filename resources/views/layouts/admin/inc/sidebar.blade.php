 <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{(Auth::user()->avatar !=null) ? asset('assets/backend/profile/'.Auth::user()->avatar) : asset('assets/backend/profile/default.jpg')}}" class="img-circle elevation-2" alt="User Image">
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
            <a href="{{ route('all.blood.request') }}" class="nav-link {{(Request::routeIs('all.blood.request')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Blood Request
              </p>
            </a>
          </li>

            <li class="nav-item {{(Request::routeIs('all.users','paid.users','unpaid.users')) ? 'active' : ''}}">
            <a href="#" class="nav-link {{(Request::routeIs('all.users','paid.users','unpaid.users')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('all.users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('uncheck.users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paid and Uncheck</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('paid.users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paid and Check</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('unpaid.users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unpaid Users</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('payment') }}" class="nav-link {{(Request::routeIs('payment')) ? 'active' : ''}}" >
              <i class="fas fa-credit-card"></i> 
               <p style="padding-left: 10px">Payment Method</p>
            </a>
          </li>
       
          <li class="nav-item {{(Request::routeIs('division.index','division.create')) ? 'active' : ''}}">
            <a href="#" class="nav-link {{(Request::routeIs('division.index','division.create')) ? 'active' : ''}}">
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
            <a href="#" class="nav-link {{(Request::routeIs('district.index','district.create')) ? 'active' : ''}}">
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
            <a href="#" class="nav-link {{(Request::routeIs('police_station.index','police_station.create')) ? 'active' : ''}}">
             <i class="nav-icon fab fa-artstation"></i>
              <p>
                Police Stations
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
            <a href="#" class="nav-link {{(Request::routeIs('hospital.index','hospital.create')) ? 'active' : ''}}">
             <i class="nav-icon fab fa-artstation"></i>
              <p>
                Hospital
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('hospital.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hospital List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('hospital.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hospital Create</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-item ">
            <a href="#" class="nav-link {{(Request::routeIs('ambulance.index','ambulance.create')) ? 'active' : ''}}">
             <i class="nav-icon fas fa-ambulance"></i>
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
            <a href="#" class="nav-link {{(Request::routeIs('touring_place.index','touring_place.create')) ? 'active' : ''}}">
              <i class="nav-icon fab fa-watchman-monitoring"></i>
              <p>
                Touring Places
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
            <a href="#" class="nav-link {{(Request::routeIs('hotel.index','hotel.create')) ? 'active' : ''}}">
             <i class="nav-icon fas fa-hotel"></i>
              <p>
                Hotels
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
            <a href="#" class="nav-link {{(Request::routeIs('blood_bank.index','blood_bank.create')) ? 'active' : ''}}">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Blood Banks
                <i class=" right fas fa-angle-left"></i>
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
            <a href="#" class="nav-link {{(Request::routeIs('notification.index','notification.create')) ? 'active' : ''}}">
             <i class="nav-icon fas fa-bell-slash"></i>
              <p>
                Notifications
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


          <li class="nav-item">
            <a href="{{ route('user.complain') }}" class="nav-link {{(Request::routeIs('user.complain')) ? 'active' : ''}}">
              <i class="fas fa-box-tissue"></i>
              <p>
                User Complains
              </p>
            </a>
          </li>

        

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>