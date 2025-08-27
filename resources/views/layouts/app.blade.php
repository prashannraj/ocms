<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Dashboard')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      background: #f4f5fa;
    }

    .sidebar {
      width: 250px;
      min-height: 100vh;
      background: #e0e7ff;
      position: fixed;
      transition: all 0.3s ease;
    }

    .sidebar.collapsed {
      width: 80px;
    }

    .sidebar.collapsed .sidebar-text {
      display: none;
    }

    .main-content {
      margin-left: 250px;
      padding: 2rem;
      transition: margin-left 0.3s ease;
    }

    .sidebar.collapsed ~ .main-content {
      margin-left: 80px;
    }

    .hamburger {
      border: none;
      background: transparent;
      font-size: 1.5rem;
    }

    .logo-toggle-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>
<body>
  @include('partials.sidebar')

  <div class="main-content">
    @include('partials.navbar')

    {{-- Main Content --}}
    @yield('content')

    @include('partials.footer')
  </div>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  {{-- Sidebar Toggle Script --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggleBtn = document.getElementById('sidebarToggle');
      const sidebar = document.querySelector('.sidebar');

      toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
      });
    });
  </script>
</body>
</html>
