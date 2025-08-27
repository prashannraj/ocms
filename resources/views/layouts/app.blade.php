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
    body { background: #f4f5fa; }
    .sidebar { width: 250px; min-height: 100vh; background: #e0e7ff; position: fixed; }
    .main-content { margin-left: 250px; padding: 2rem; }
  </style>
</head>
<body>
  @include('partials.sidebar')
  <div class="main-content">
    @include('partials.navbar')
    {{-- Main Content --}}
    @yield('content')
  </div>
  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
