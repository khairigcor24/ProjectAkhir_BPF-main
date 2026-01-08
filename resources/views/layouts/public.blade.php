<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'SEJAHTERA' }}</title>
    <meta name="viewport" content="wkok kayak gini ya tampilannya, tolong baguskan dan include gambar-gambar yang udah aku masukkanidth=device-width, initial-scale=1">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css') }}" rel="stylesheet">
</head>
<body>S=

    {{-- NAVBAR PUBLIC --}}
    @include('layouts.navbars.navs.public')

    {{-- CONTENT --}}
    @yield('content')

    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    @stack('js')
</body>
</html>
