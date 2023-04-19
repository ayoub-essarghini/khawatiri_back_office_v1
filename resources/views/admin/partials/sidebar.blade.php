    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav" id="nav" >
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="{{Auth::user()->image_path =="" ? asset('assets/images/admin/avatar.png') : asset('assets/images/admin/' . Auth::user()->image_path) }}" alt="profile">
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">{{Auth::user()->fname == "" ? "Admin" : Auth::user()->fname.' '. Auth::user()->lname }}</span>
                <span class="text-secondary text-small">Super Admin</span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-view-dashboard menu-icon"></i>
            </a>
          </li>    
          <li class="nav-item">
            <a class="nav-link" href="{{route('categories.index')}}">
              <span class="menu-title">Categories</span>
              <i class="mdi mdi-shape-plus menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('quotes.index')}}">
              <span class="menu-title">Quotes</span>
              <i class="mdi mdi-format-quote-close menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
              <span class="menu-title">Users</span>
              <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
          </li>
        
        </ul>
      </nav>
  