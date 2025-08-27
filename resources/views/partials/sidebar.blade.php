<div class="sidebar d-flex flex-column p-3 text-dark">

  {{-- ✅ Logo क्लिक गर्दा Dashboard मा जाने --}}
  <div class="mb-2 text-center">
    <a href="{{ route('dashboard') }}">
      <img src="{{ asset($officeSettings->app_logo) }}" alt="Logo" width="50" height="50" class="me-2">
    </a>
  </div>

  {{-- ✅ App Name क्लिक गर्दा Dashboard मा जाने --}}
  <h4 class="mb-4 text-center">
    <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
      {{ $officeSettings->app_name }}
    </a>
  </h4>

  {{-- Menu Items --}}
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="{{ route('dashboard') }}" class="nav-link text-dark">
        <i class="bi bi-house-door me-2"></i>Dashboard
      </a>
    </li>
    <li><a href="#" class="nav-link text-dark"><i class="bi bi-box me-2"></i>Basic UI</a></li>
    <li><a href="#" class="nav-link text-dark"><i class="bi bi-bar-chart me-2"></i>Charts</a></li>
    <li><a href="#" class="nav-link text-dark"><i class="bi bi-table me-2"></i>Tables</a></li>
    <li><a href="#" class="nav-link text-dark"><i class="bi bi-info-circle me-2"></i>Documentation</a></li>
    
    <li>
    <a href="{{ route('office_settings.edit') }}" class="nav-link text-dark">
      <i class="bi bi-gear me-2"></i> Office Setting
    </a>
  </li>
    
    
  </ul>
</div>
