<!--
=========================================================
SISTEM BANSOS - Aplikasi Manajemen Bantuan Sosial
=========================================================

 Sistem Informasi Manajemen Bantuan Sosial
 Platform Terintegrasi untuk Donasi & Penyaluran Bantuan

=========================================================
-->
<!DOCTYPE html>

<html lang="id">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>{{ $title }} | Sistem Bansos</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <meta name="description" content="Sistem Informasi Manajemen Bantuan Sosial - Platform Terintegrasi untuk Donasi dan Penyaluran Bantuan Sosial" />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <!-- CSS Files -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.0') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/layout-improvements.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/content-pages.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/final-fixes.css') }}" rel="stylesheet" />
        @stack('css')
    </head>

    <body>
    <div class="wrapper 
        @if (request()->route()->getName() == 'login' || request()->route()->getName() == 'register') 
            wrapper-full-page 
        @endif">
        
        {{-- === SIDEBAR === --}}
        @if (auth()->check() && request()->route()->getName() != "")
            @include('layouts.navbars.sidebar')
        @endif

        {{-- === MAIN PANEL === --}}
        <div class="@if (auth()->check() && request()->route()->getName() != '') main-panel @endif">
            @include('layouts.navbars.navbar')

            <div class="content-wrapper">
                @yield('content')
            </div>

            @include('layouts.footer.nav')
        </div>

    </div>
</body>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/js/plugins/jquery.sharrre.js') }}"></script>
    <!--  Plugin for Switches -->
    <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Chartist Plugin  -->
    <script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Light Bootstrap Dashboard -->
    <script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>
    <!-- Light Bootstrap Dashboard DEMO methods -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <!-- Enhanced Layout Scripts -->
    <script src="{{ asset('assets/js/layout-enhancements.js') }}" type="text/javascript"></script>

    @stack('js')

    <script>
        $(document).ready(function () {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                delay: { show: 500, hide: 100 }
            });

            // Smooth scroll for anchor links
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                var target = $(this.getAttribute('href'));
                if(target.length) {
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 80
                    }, 1000);
                }
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert:not(.alert-permanent)').fadeOut('slow');
            }, 5000);

            // Add loading state to form submissions
            $('form').on('submit', function() {
                var submitBtn = $(this).find('button[type="submit"]');
                var originalText = submitBtn.text();
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            });

            // Responsive sidebar toggle
            if($(window).width() <= 991) {
                $('.sidebar').addClass('sidebar-mobile');
            }

            $(window).resize(function() {
                if($(window).width() <= 991) {
                    $('.sidebar').addClass('sidebar-mobile');
                } else {
                    $('.sidebar').removeClass('sidebar-mobile');
                }
            });

            // Enhanced navigation active state
            var currentUrl = window.location.pathname;
            $('.nav a').each(function() {
                var href = $(this).attr('href');
                if(href === currentUrl || currentUrl.includes(href.replace('index', ''))) {
                    $(this).closest('li').addClass('active');
                }
            });
        });
    </script>
</html>
