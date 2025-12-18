<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/light-bootstrap-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/demo.css') }}">

    @stack('css')
</head>
<body>

<div class="wrapper">
    @include('partials.navbars.sidebar')

    <div class="main-panel">
        @include('partials.navbars.navbar')

        @yield('content')

        @include('partials.footer.nav')
    </div>
</div>

<script src="{{ asset('assets-admin/js/core/jquery.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/light-bootstrap-dashboard.js') }}"></script>
<script src="{{ asset('assets-admin/js/demo.js') }}"></script>

@stack('js')
</body>
</html>


