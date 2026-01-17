<div class="sidebar" data-color="blue" data-image="{{ asset('assets/img/sidebar-5.jpg') }}">
    <div class="sidebar-wrapper">
        <ul class="nav">
            {{-- ============================================ --}}
            {{-- DASHBOARD - ALL AUTHENTICATED USERS --}}
            {{-- ============================================ --}}
            <li class="{{ $activePage == 'dashboard' ? 'active' : '' }} nav-dashboard">
                <a href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            {{-- ============================================ --}}
            {{-- ADMIN ONLY MENU --}}
            {{-- ============================================ --}}
            @if (auth()->user()->isAdmin())
                <li class="nav-category">
                    <span class="nav-category-title">
                        <i class="nc-icon nc-circle-10"></i> MANAJEMEN PENGGUNA
                    </span>
                </li>
                <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link" data-toggle="tooltip" title="Kelola pengguna sistem">
                        <i class="nc-icon nc-circle-10"></i>
                        <p>User Management</p>
                    </a>
                </li>

                <li class="nav-category">
                    <span class="nav-category-title">
                        <i class="nc-icon nc-paper-2"></i> PROGRAM BANTUAN
                    </span>
                </li>
                <li class="{{ request()->routeIs('program-bansos.*') ? 'active' : '' }}">
                    <a href="{{ route('program-bansos.index') }}" class="nav-link" data-toggle="tooltip" title="Kelola program bantuan sosial">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Program Bansos</p>
                    </a>
                </li>

                <li class="nav-category">
                    <span class="nav-category-title">
                        <i class="nc-icon nc-badge"></i> PENERIMA BANTUAN
                    </span>
                </li>
                <li class="{{ request()->routeIs('penerima-bansos.*') ? 'active' : '' }}">
                    <a href="{{ route('penerima-bansos.index') }}" class="nav-link" data-toggle="tooltip" title="Kelola data penerima bantuan">
                        <i class="nc-icon nc-badge"></i>
                        <p>Penerima Bansos</p>
                    </a>
                </li>

                <li class="nav-category">
                    <span class="nav-category-title">
                        <i class="nc-icon nc-delivery-fast"></i> PENYALURAN BANTUAN
                    </span>
                </li>
                <li class="{{ request()->routeIs('penyaluran-bansos.*') ? 'active' : '' }}">
                    <a href="{{ route('penyaluran-bansos.index') }}" class="nav-link" data-toggle="tooltip" title="Pantau penyaluran bantuan">
                        <i class="nc-icon nc-delivery-fast"></i>
                        <p>Penyaluran Bansos</p>
                    </a>
                </li>

                <li class="nav-category">
                    <span class="nav-category-title">
                        <i class="nc-icon nc-heart-2"></i> MANAJEMEN DONASI
                    </span>
                </li>
                <li class="{{ request()->routeIs('donasi.*') ? 'active' : '' }}">
                    <a href="{{ route('donasi.index') }}" class="nav-link" data-toggle="tooltip" title="Kelola donasi masuk">
                        <i class="nc-icon nc-heart-2"></i>
                        <p>Kelola Donasi</p>
                    </a>
                </li>

                <li class="nav-category">
                    <span class="nav-category-title">
                        <i class="nc-icon nc-gift-2"></i> MANAJEMEN ASET
                    </span>
                </li>
                <li class="{{ request()->routeIs('bansos.*') ? 'active' : '' }}">
                    <a href="{{ route('bansos.index') }}" class="nav-link" data-toggle="tooltip" title="Kelola aset bantuan sosial">
                        <i class="nc-icon nc-gift-2"></i>
                        <p>Bansos Management</p>
                    </a>
                </li>
            @endif

            {{-- ============================================ --}}
            {{-- STAFF ONLY MENU --}}
            {{-- ============================================ --}}
            @if (auth()->user()->isStaff())
                <li class="nav-category">
                    <span class="nav-category-title">
                        <i class="nc-icon nc-check-2"></i> VERIFIKASI DATA
                    </span>
                </li>
                <li class="{{ request()->routeIs('penerima-bansos.*') ? 'active' : '' }}">
                    <a href="{{ route('penerima-bansos.index') }}" class="nav-link" data-toggle="tooltip" title="Verifikasi data penerima bantuan">
                        <i class="nc-icon nc-badge"></i>
                        <p>Verifikasi Penerima</p>
                    </a>
                </li>

                <li class="{{ request()->routeIs('donasi.*') ? 'active' : '' }}">
                    <a href="{{ route('donasi.index') }}" class="nav-link" data-toggle="tooltip" title="Verifikasi donasi yang masuk">
                        <i class="nc-icon nc-heart-2"></i>
                        <p>Verifikasi Donasi</p>
                    </a>
                </li>

                <li class="nav-category">
                    <span class="nav-category-title">
                        <i class="nc-icon nc-delivery-fast"></i> PENYALURAN
                    </span>
                </li>
                <li class="{{ request()->routeIs('penyaluran-bansos.*') ? 'active' : '' }}">
                    <a href="{{ route('penyaluran-bansos.index') }}" class="nav-link" data-toggle="tooltip" title="Pantau proses penyaluran bantuan">
                        <i class="nc-icon nc-delivery-fast"></i>
                        <p>Penyaluran Bansos</p>
                    </a>
                </li>
            @endif

            {{-- ============================================ --}}
            {{-- USER / WARGA MENU --}}
            {{-- ============================================ --}}
            @if (auth()->check() && auth()->user()->role === 'user')
                <li class="{{ request()->routeIs('donasi.user') ? 'active' : '' }}">
                    <a href="{{ route('donasi.user') }}" class="nav-link">
                        <i class="nc-icon nc-heart-2"></i>
                        <p>Ajukan Bantuan</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
