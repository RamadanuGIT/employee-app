<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="{{Route::is('admin.dashboard') ? 'nav-link':'nav-link collapsed'}}" href="{{route('admin.dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item menu-open">
        <a class="{{Route::is('employee*') ? 'nav-link':'nav-link collapsed'}}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" aria-expanded="true">
          <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav" nav-content="" collapse="" show="" style="">
          <li>
            <a href="{{route('employee')}}" class="{{Route::is('employe*') ? 'active':''}}">
              <i class="bi bi-circle"></i><span>Employee</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
    </ul>

  </aside><!-- End Sidebar-->
