<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'SEJAHTERA' }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet">
</head>
<body>

    {{-- PUBLIC NAVBAR --}}
    @include('layouts.navbars.public')

    {{-- CONTENT --}}
    @yield('content')

    {{-- JS --}}
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    @stack('js')
</body>
</html>
