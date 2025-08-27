<div class="sidebar d-flex flex-column p-3 text-dark">
  <div class="logo-toggle-wrapper mb-4 px-2">
    <a href="{{ route('dashboard') }}">
      <img src="{{ asset($officeSettings->app_logo) }}" alt="Logo" width="40" height="40" class="me-2">
    </a>

    <!-- Toggle Button (3-line hamburger) -->
    <button id="sidebarToggle" class="hamburger">
      <i class="bi bi-list"></i>
    </button>
  </div>

  <h5 class="text-center sidebar-text">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
      {{ $officeSettings->app_name }}
    </a>
  </h5>

  <ul class="nav nav-pills flex-column mb-auto mt-3">
    <li class="nav-item">
      <a href="{{ route('dashboard') }}" class="nav-link text-dark">
        <i class="bi bi-house-door me-2"></i><span class="sidebar-text">Dashboard</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link text-dark">
        <i class="bi bi-box me-2"></i><span class="sidebar-text">Basic UI</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link text-dark">
        <i class="bi bi-bar-chart me-2"></i><span class="sidebar-text">Charts</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link text-dark">
        <i class="bi bi-table me-2"></i><span class="sidebar-text">Tables</span>
      </a>
    </li>
    <li>
      <a href="#" class="nav-link text-dark">
        <i class="bi bi-info-circle me-2"></i><span class="sidebar-text">Documentation</span>
      </a>
    </li>
    <li>
      <a href="{{ route('office_settings.edit') }}" class="nav-link text-dark">
        <i class="bi bi-gear me-2"></i><span class="sidebar-text">Office Setting</span>
      </a>
    </li>

    <li>
      <a href="{{ route('users.index') }}" class="nav-link text-dark">
        <i class="bi bi-people me-2"></i>
        <span class="sidebar-text">Users</span>
      </a>
    </li>

  </ul>
</div>
