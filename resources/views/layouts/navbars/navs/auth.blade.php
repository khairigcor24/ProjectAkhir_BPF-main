<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-admin">
    <div class="container-fluid">
        <!-- Navbar Brand / Page Title -->
        <span class="navbar-brand navbar-brand-autodark d-none d-md-flex">
            <i class="nc-icon nc-chart-pie-35" style="color: #51cbce; font-size: 20px; margin-right: 10px;"></i>
            <span class="font-weight-bold" style="color: #51cbce;">Sistem Bansos</span>
        </span>

        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-danger badge-counter" style="display: none;">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-md animated--grow-in" aria-labelledby="notificationDropdown">
                        <h6 class="dropdown-header bg-light font-weight-bold" style="color: #51cbce;">Notifikasi</h6>
                        <a class="dropdown-item small text-gray-500" href="#">
                            <i class="fa fa-check text-success"></i> Data diperbarui
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item small" href="#">Lihat semua notifikasi</a>
                    </div>
                </li>

                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-profile-summary" style="display: flex; align-items: center; gap: 10px;">
                            <img src="{{ auth()->user()->avatar ?? 'https://via.placeholder.com/32' }}" alt="User" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                            <div class="d-none d-md-flex flex-column" style="font-size: 12px;">
                                <strong>{{ auth()->user()->name }}</strong>
                                <small style="color: #51cbce;">{{ auth()->user()->role }}</small>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-md animated--grow-in" aria-labelledby="userDropdown">
                        <h6 class="dropdown-header bg-light" style="border-bottom: 2px solid #51cbce; color: #51cbce; font-weight: 700;">
                            <i class="fa fa-user-circle"></i> Akun Saya
                        </h6>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fa fa-user"></i> Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fa fa-cog"></i> Pengaturan
                        </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="fa fa-sign-out"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>

                <!-- Dark Mode Toggle (Optional) -->
                <li class="nav-item ml-3">
                    <a class="nav-link" href="#" id="themeToggle" title="Toggle Dark Mode">
                        <i class="fa fa-moon"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-admin {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%) !important;
        border-bottom: 2px solid #51cbce;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 12px 0;
    }

    .navbar-brand-autodark {
        font-size: 16px;
        color: #2d3748;
        text-decoration: none;
    }

    .nav-link {
        color: #2d3748 !important;
        font-weight: 500;
        font-size: 13px;
        margin: 0 8px;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-link:hover {
        color: #51cbce !important;
        transform: translateY(-2px);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        right: 0;
        height: 2px;
        background: #51cbce;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }

    .nav-link:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }

    .badge-counter {
        display: inline-flex;
        font-size: 10px;
        padding: 2px 6px;
        margin-left: -8px;
    }

    .dropdown-menu {
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        min-width: 250px;
    }

    .dropdown-header {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        background: #f8fafc !important;
    }

    .dropdown-item {
        font-size: 13px;
        color: #2d3748;
        transition: all 0.2s ease;
        padding: 10px 16px;
    }

    .dropdown-item:hover {
        background: rgba(81, 203, 206, 0.08);
        color: #51cbce;
        padding-left: 20px;
    }

    .dropdown-item i {
        width: 18px;
        margin-right: 8px;
        text-align: center;
        color: #51cbce;
    }

    .dropdown-divider {
        border-top: 1px solid #e0e7ff;
        margin: 8px 0;
    }

    .user-profile-summary {
        text-align: right;
    }

    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        box-shadow: none;
        outline: 1px solid #51cbce;
    }

    .animated--grow-in {
        animation: growIn 0.3s ease-in-out;
    }

    @keyframes growIn {
        0% {
            opacity: 0;
            transform: scale(0.95);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @media (max-width: 768px) {
        .navbar-brand-autodark {
            font-size: 14px;
        }

        .nav-link {
            padding: 10px 0;
            margin: 0;
            font-size: 14px;
        }

        .user-profile-summary {
            text-align: left;
        }

        .dropdown-menu {
            min-width: auto;
            right: 0 !important;
            left: auto !important;
        }
    }
</style>
