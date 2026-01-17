<ul class="nav">
    {{-- DASHBOARD - ALL AUTHENTICATED USERS --}}
    <li class="{{ $activePage == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" data-toggle="tooltip" data-placement="right" title="Beranda Sistem Bansos">
            <i class="nc-icon nc-chart-pie-35"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- ============================================ --}}
    {{-- ADMIN ONLY MENU --}}
    {{-- ============================================ --}}
    @if(auth()->user()->isAdmin())
        <li class="separator"></li>
        <div class="admin-section">
            <!-- Section Header: MANAJEMEN PENGGUNA -->
            <li class="nav-section-header">
                <p class="section-title">
                    <i class="nc-icon nc-single-02"></i> MANAJEMEN PENGGUNA
                </p>
            </li>
            <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="nav-item-admin" data-toggle="tooltip" data-placement="right" title="Kelola Pengguna Sistem">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-single-02"></i>
                    </span>
                    <p>User Management</p>
                    <b class="caret"></b>
                </a>
            </li>

            <!-- Section Header: PROGRAM BANTUAN -->
            <li class="nav-section-header">
                <p class="section-title">
                    <i class="nc-icon nc-paper-2"></i> PROGRAM BANTUAN
                </p>
            </li>
            <li class="{{ request()->routeIs('program-bansos.*') ? 'active' : '' }}">
                <a href="{{ route('program-bansos.index') }}" class="nav-item-admin" data-toggle="tooltip" data-placement="right" title="Kelola Program Bantuan Sosial">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-paper-2"></i>
                    </span>
                    <p>Program Bansos</p>
                    <b class="caret"></b>
                </a>
            </li>

            <!-- Section Header: MANAJEMEN PENERIMA & PENYALURAN -->
            <li class="nav-section-header">
                <p class="section-title">
                    <i class="nc-icon nc-badge"></i> PENERIMA & PENYALURAN
                </p>
            </li>
            <li class="{{ request()->routeIs('penerima-bansos.*') ? 'active' : '' }}">
                <a href="{{ route('penerima-bansos.index') }}" class="nav-item-admin" data-toggle="tooltip" data-placement="right" title="Kelola Penerima Bantuan">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-badge"></i>
                    </span>
                    <p>Penerima Bansos</p>
                    <b class="caret"></b>
                </a>
            </li>

            <li class="{{ request()->routeIs('penyaluran-bansos.*') ? 'active' : '' }}">
                <a href="{{ route('penyaluran-bansos.index') }}" class="nav-item-admin" data-toggle="tooltip" data-placement="right" title="Pantau Penyaluran Bantuan">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-delivery-fast"></i>
                    </span>
                    <p>Penyaluran Bansos</p>
                    <b class="caret"></b>
                </a>
            </li>

            <!-- Section Header: MANAJEMEN DONASI & ASET -->
            <li class="nav-section-header">
                <p class="section-title">
                    <i class="nc-icon nc-money-coins"></i> DONASI & ASET
                </p>
            </li>
            <li class="{{ request()->routeIs('donasi.*') ? 'active' : '' }}">
                <a href="{{ route('donasi.index') }}" class="nav-item-admin" data-toggle="tooltip" data-placement="right" title="Kelola Donasi Masyarakat">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-money-coins"></i>
                    </span>
                    <p>Kelola Donasi</p>
                    <b class="caret"></b>
                </a>
            </li>

            <li class="{{ request()->routeIs('bansos.*') ? 'active' : '' }}">
                <a href="{{ route('bansos.index') }}" class="nav-item-admin" data-toggle="tooltip" data-placement="right" title="Manajemen Bantuan Sosial">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-gift-2"></i>
                    </span>
                    <p>Bansos Management</p>
                    <b class="caret"></b>
                </a>
            </li>
        </div>
    @endif

    {{-- ============================================ --}}
    {{-- STAFF ONLY MENU --}}
    {{-- ============================================ --}}
    @if(auth()->user()->isStaff())
        <li class="separator"></li>
        <div class="staff-section">
            <!-- Section Header: VERIFIKASI & PENGAWASAN -->
            <li class="nav-section-header">
                <p class="section-title">
                    <i class="nc-icon nc-check-2"></i> VERIFIKASI
                </p>
            </li>
            <li class="{{ request()->routeIs('penerima-bansos.*') ? 'active' : '' }}">
                <a href="{{ route('penerima-bansos.index') }}" class="nav-item-staff" data-toggle="tooltip" data-placement="right" title="Verifikasi Calon Penerima">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-badge"></i>
                    </span>
                    <p>Verifikasi Penerima</p>
                    <b class="caret"></b>
                </a>
            </li>

            <li class="{{ request()->routeIs('donasi.*') ? 'active' : '' }}">
                <a href="{{ route('donasi.index') }}" class="nav-item-staff" data-toggle="tooltip" data-placement="right" title="Verifikasi Donasi Masuk">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-check-2"></i>
                    </span>
                    <p>Verifikasi Donasi</p>
                    <b class="caret"></b>
                </a>
            </li>

            <!-- Section Header: PENYALURAN -->
            <li class="nav-section-header">
                <p class="section-title">
                    <i class="nc-icon nc-delivery-fast"></i> PENYALURAN
                </p>
            </li>
            <li class="{{ request()->routeIs('penyaluran-bansos.*') ? 'active' : '' }}">
                <a href="{{ route('penyaluran-bansos.index') }}" class="nav-item-staff" data-toggle="tooltip" data-placement="right" title="Kelola Penyaluran Bantuan">
                    <span class="nav-icon-wrapper">
                        <i class="nc-icon nc-delivery-fast"></i>
                    </span>
                    <p>Penyaluran Bansos</p>
                    <b class="caret"></b>
                </a>
            </li>
        </div>
    @endif

    {{-- ============================================ --}}
    {{-- USER / WARGA MENU --}}
    {{-- ============================================ --}}
    @if(auth()->check() && auth()->user()->role === 'user')
        <li class="separator"></li>
        <div class="user-section">
            {{-- Ajukan Bantuan --}}
            <li class="{{ request()->routeIs('donasi.user') ? 'active' : '' }}">
                <a href="{{ route('donasi.user') }}" data-toggle="tooltip" data-placement="right" title="Ajukan Permohonan Bantuan">
                    <i class="nc-icon nc-heart-2"></i>
                    <p>Ajukan Bantuan</p>
                </a>
            </li>
        </div>
    @endif

</ul>

<style>
    /* Sidebar Navigation Styling */
    .nav {
        position: relative;
    }

    /* Section Headers */
    .nav-section-header {
        padding: 12px 15px 8px 15px;
        margin-top: 8px;
    }

    .section-title {
        font-size: 11px;
        font-weight: 700;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .section-title i {
        font-size: 12px;
    }

    /* Admin Section Items */
    .admin-section li a.nav-item-admin,
    .staff-section li a.nav-item-staff {
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding-left: 15px;
        border-left: 3px solid transparent;
        overflow: hidden;
    }

    .admin-section li a.nav-item-admin::before,
    .staff-section li a.nav-item-staff::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(135deg, #51cbce, #3fb1ba);
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .admin-section li a.nav-item-admin:hover,
    .staff-section li a.nav-item-staff:hover {
        background-color: rgba(81, 203, 206, 0.08);
        border-left-color: #51cbce;
    }

    .admin-section li a.nav-item-admin:hover::before,
    .staff-section li a.nav-item-staff:hover::before {
        transform: scaleY(1);
    }

    /* Icon Wrapper */
    .nav-icon-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 6px;
        margin-right: 8px;
        background-color: rgba(81, 203, 206, 0.15);
        transition: all 0.3s ease;
        color: #51cbce;
    }

    .admin-section li:hover .nav-icon-wrapper,
    .staff-section li:hover .nav-icon-wrapper {
        background-color: rgba(81, 203, 206, 0.25);
        transform: scale(1.1);
    }

    .admin-section li.active .nav-icon-wrapper,
    .staff-section li.active .nav-icon-wrapper {
        background: linear-gradient(135deg, #51cbce, #3fb1ba);
        color: #fff;
        box-shadow: 0 4px 12px rgba(81, 203, 206, 0.3);
    }

    /* Active State */
    .admin-section li.active > a.nav-item-admin,
    .staff-section li.active > a.nav-item-staff {
        background-color: rgba(81, 203, 206, 0.15);
        border-left-color: #51cbce;
        color: #51cbce;
        font-weight: 600;
    }

    .admin-section li.active > a.nav-item-admin::before,
    .staff-section li.active > a.nav-item-staff::before {
        transform: scaleY(1);
    }

    /* Caret for visual enhancement */
    .nav-item-admin .caret,
    .nav-item-staff .caret {
        display: none;
    }

    /* Responsive adjustments */
    @media (max-width: 991px) {
        .section-title {
            font-size: 10px;
        }

        .admin-section li a.nav-item-admin,
        .staff-section li a.nav-item-staff {
            padding-left: 12px;
        }

        .nav-icon-wrapper {
            width: 22px;
            height: 22px;
            font-size: 13px;
        }
    }
</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    // Add smooth animation to section headers
    $('.nav-section-header').each(function() {
        $(this).animate({opacity: 1}, 300);
    });

    // Enhanced hover effects
    $('.nav-item-admin, .nav-item-staff').on('mouseenter', function() {
        $(this).find('.nav-icon-wrapper').addClass('animate-icon');
    }).on('mouseleave', function() {
        $(this).find('.nav-icon-wrapper').removeClass('animate-icon');
    });
});
</script>
