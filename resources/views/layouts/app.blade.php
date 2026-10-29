<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - Ration Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('assets/css/adminpanel.css') }}" rel="stylesheet">
  @yield('styles')

  <!-- Scripts every page needs. They are in the head so they are ready before the page scripts run -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  @include('partials.sidebar')

  <div class="main-content">

    @include('partials.topbar')

    <!-- Only this box is replaced when a sidebar link is clicked -->
    <div id="page-content" class="p-4">

      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @yield('content')

      <!-- Page scripts (@push('scripts')) stay inside the box, so they run again for every page -->
      @stack('scripts')
    </div>

  </div>

  <!-- Keep your sidebar.js line here if you have one -->
  <script src="{{ asset('assets/js/ajax-nav.js') }}"></script>
</body>
</html>