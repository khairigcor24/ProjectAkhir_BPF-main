<ul class="nav">
    {{-- DASHBOARD - ALL AUTHENTICATED USERS --}}
    <li class="{{ $activePage == 'dashboard' ? 'active' : '' }} nav-dashboard">
        <a href="{{ route('dashboard') }}">
            <i class="nc-icon nc-chart-pie-35"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- ============================================ --}}
    {{-- ADMIN ONLY MENU --}}
    {{-- ============================================ --}}
    @if(auth()->user()->isAdmin())
        <!-- MANAJEMEN PENGGUNA SECTION -->
        <li class="nav-category">
            <span class="nav-category-title">
                <i class="nc-icon nc-single-02"></i> MANAJEMEN PENGGUNA
            </span>
        </li>
        <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="nav-link">
                <i class="nc-icon nc-single-02"></i>
                <p>User Management</p>
            </a>
        </li>

        <!-- PROGRAM BANTUAN SECTION -->
        <li class="nav-category">
            <span class="nav-category-title">
                <i class="nc-icon nc-briefcase-2"></i> PROGRAM BANTUAN
            </span>
        </li>
        <li class="{{ request()->routeIs('program-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('program-bansos.index') }}" class="nav-link">
                <i class="nc-icon nc-briefcase-2"></i>
                <p>Program Bansos</p>
            </a>
        </li>

        <!-- PENERIMA BANTUAN SECTION -->
        <li class="nav-category">
            <span class="nav-category-title">
                <i class="nc-icon nc-badge"></i> PENERIMA BANTUAN
            </span>
        </li>
        <li class="{{ request()->routeIs('penerima-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('penerima-bansos.index') }}" class="nav-link">
                <i class="nc-icon nc-badge"></i>
                <p>Penerima Bansos</p>
            </a>
        </li>

        <!-- PENYALURAN BANTUAN SECTION -->
        <li class="nav-category">
            <span class="nav-category-title">
                <i class="nc-icon nc-delivery-fast"></i> PENYALURAN BANTUAN
            </span>
        </li>
        <li class="{{ request()->routeIs('penyaluran-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('penyaluran-bansos.index') }}" class="nav-link">
                <i class="nc-icon nc-delivery-fast"></i>
                <p>Penyaluran Bansos</p>
            </a>
        </li>

        <!-- MANAJEMEN DONASI SECTION -->
        <li class="nav-category">
            <span class="nav-category-title">
                <i class="nc-icon nc-money-coins"></i> MANAJEMEN DONASI
            </span>
        </li>
        <li class="{{ request()->routeIs('donasi.*') ? 'active' : '' }}">
            <a href="{{ route('donasi.index') }}" class="nav-link">
                <i class="nc-icon nc-money-coins"></i>
                <p>Kelola Donasi</p>
            </a>
        </li>

        <!-- MANAJEMEN ASET BANSOS SECTION -->
        <li class="nav-category">
            <span class="nav-category-title">
                <i class="nc-icon nc-gift-2"></i> MANAJEMEN ASET
            </span>
        </li>
        <li class="{{ request()->routeIs('bansos.*') ? 'active' : '' }}">
            <a href="{{ route('bansos.index') }}" class="nav-link">
                <i class="nc-icon nc-gift-2"></i>
                <p>Bansos Management</p>
            </a>
        </li>
    @endif

    {{-- ============================================ --}}
    {{-- STAFF ONLY MENU --}}
    {{-- ============================================ --}}
    @if(auth()->user()->isStaff())
        <!-- VERIFIKASI DATA SECTION -->
        <li class="nav-category">
            <span class="nav-category-title">
                <i class="nc-icon nc-check-2"></i> VERIFIKASI DATA
            </span>
        </li>
        <li class="{{ request()->routeIs('penerima-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('penerima-bansos.index') }}" class="nav-link">
                <i class="nc-icon nc-badge"></i>
                <p>Verifikasi Penerima</p>
            </a>
        </li>

        <li class="{{ request()->routeIs('donasi.*') ? 'active' : '' }}">
            <a href="{{ route('donasi.index') }}" class="nav-link">
                <i class="nc-icon nc-check-2"></i>
                <p>Verifikasi Donasi</p>
            </a>
        </li>

        <!-- PENYALURAN SECTION -->
        <li class="nav-category">
            <span class="nav-category-title">
                <i class="nc-icon nc-delivery-fast"></i> PENYALURAN
            </span>
        </li>
        <li class="{{ request()->routeIs('penyaluran-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('penyaluran-bansos.index') }}" class="nav-link">
                <i class="nc-icon nc-delivery-fast"></i>
                <p>Penyaluran Bansos</p>
            </a>
        </li>
    @endif

    {{-- ============================================ --}}
    {{-- USER / WARGA MENU --}}
    {{-- ============================================ --}}
    @if(auth()->check() && auth()->user()->role === 'user')
        <li class="{{ request()->routeIs('donasi.user') ? 'active' : '' }}">
            <a href="{{ route('donasi.user') }}" class="nav-link">
                <i class="nc-icon nc-heart-2"></i>
                <p>Ajukan Bantuan</p>
            </a>
        </li>
    @endif

</ul>

<style>
    /* ============================================
       SIDEBAR NAVIGATION STYLING
       ============================================ */

    :root {
        --primary-teal: #51cbce;
        --primary-dark: #3fb1ba;
        --accent-light: rgba(81, 203, 206, 0.08);
        --accent-lighter: rgba(81, 203, 206, 0.12);
        --text-muted: #999;
        --text-dark: #333;
    }

    .nav {
        position: relative;
        padding: 0;
        margin: 0;
    }

    /* Dashboard Item */
    .nav-dashboard {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .nav-dashboard a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px !important;
        background: transparent !important;
        color: var(--text-dark) !important;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
    }

    .nav-dashboard a i {
        font-size: 16px;
        color: var(--primary-teal);
        transition: all 0.3s ease;
    }

    .nav-dashboard a p {
        margin: 0;
    }

    .nav-dashboard:hover a {
        background-color: var(--accent-light) !important;
        padding-left: 24px !important;
    }

    .nav-dashboard:hover a i {
        transform: scale(1.1);
    }

    .nav-dashboard.active a {
        background-color: var(--accent-lighter) !important;
        border-left: 4px solid var(--primary-teal);
        color: var(--primary-teal) !important;
        font-weight: 600;
        padding-left: 16px !important;
    }

    /* Category Headers */
    .nav-category {
        list-style: none !important;
        padding: 0 !important;
        margin: 16px 0 8px 0 !important;
    }

    .nav-category-title {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
    }

    .nav-category-title i {
        font-size: 11px;
        color: var(--primary-teal);
    }

    /* Menu Items */
    .nav > li:not(.nav-dashboard):not(.nav-category) {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .nav-link {
        display: flex !important;
        align-items: center;
        gap: 12px;
        padding: 12px 20px !important;
        margin: 0 8px !important;
        background-color: transparent !important;
        color: var(--text-dark) !important;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-decoration: none !important;
        border-radius: 6px;
    }

    .nav-link i {
        font-size: 14px;
        color: var(--primary-teal);
        transition: all 0.25s ease;
        flex-shrink: 0;
    }

    .nav-link p {
        margin: 0;
        flex-grow: 1;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(180deg, var(--primary-teal), var(--primary-dark));
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1;
    }

    /* Hover State */
    .nav > li:not(.nav-dashboard):not(.nav-category):hover .nav-link {
        background-color: var(--accent-light) !important;
        color: var(--primary-teal) !important;
        transform: translateX(4px);
        padding-left: 24px !important;
    }

    .nav > li:not(.nav-dashboard):not(.nav-category):hover .nav-link::before {
        transform: scaleY(1);
    }

    .nav > li:not(.nav-dashboard):not(.nav-category):hover .nav-link i {
        transform: scale(1.15);
    }

    /* Active State */
    .nav > li.active .nav-link {
        background-color: var(--accent-lighter) !important;
        color: var(--primary-teal) !important;
        font-weight: 600;
        padding-left: 17px !important;
    }

    .nav > li.active .nav-link::before {
        transform: scaleY(1);
    }

    .nav > li.active .nav-link i {
        color: var(--primary-teal);
        font-weight: 700;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .nav-link {
            font-size: 12px;
            padding: 10px 16px !important;
            margin: 0 6px !important;
        }

        .nav-dashboard a {
            padding: 12px 16px !important;
        }

        .nav-category-title {
            font-size: 10px;
            padding: 8px 16px;
        }
    }

    @media (max-width: 768px) {
        .nav-link {
            font-size: 11px;
            padding: 8px 12px !important;
            margin: 0 4px !important;
        }

        .nav-dashboard a {
            padding: 10px 12px !important;
        }

        .nav-category-title {
            font-size: 9px;
            padding: 6px 12px;
        }
    }
</style>

<script>
$(document).ready(function(){
    var currentRoute = '{{ request()->route()->getName() }}';

    // Highlight active menu
    $('.nav > li:not(.nav-dashboard):not(.nav-category)').each(function() {
        var $link = $(this).find('.nav-link');
        var href = $link.attr('href');

        if(currentRoute && href && href.includes(currentRoute.split('.')[0])) {
            $(this).addClass('active');
        }
    });

    if(currentRoute === 'dashboard') {
        $('.nav-dashboard').addClass('active');
    }

    // Smooth animations
    $('.nav > li:not(.nav-dashboard):not(.nav-category)').each(function(index) {
        $(this).css({
            'opacity': '0',
            'transform': 'translateX(-10px)'
        }).delay(index * 30).animate({
            'opacity': '1'
        }, 300, function() {
            $(this).css('transform', 'translateX(0)');
        });
    });

    console.log('✓ Sidebar initialized');
});
</script>
