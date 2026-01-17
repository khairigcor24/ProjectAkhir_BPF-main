<ul class="nav">

    {{-- DASHBOARD - ALL AUTHENTICATED USERS --}}
    <li class="{{ $activePage == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <i class="nc-icon nc-chart-pie-35"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- ============================================ --}}
    {{-- ADMIN ONLY MENU --}}
    {{-- ============================================ --}}
    @if(auth()->user()->isAdmin())
        {{-- User Management --}}
        <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}">
                <i class="nc-icon nc-single-02"></i>
                <p>User Management</p>
            </a>
        </li>

        {{-- Program Bansos --}}
        <li class="{{ request()->routeIs('program-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('program-bansos.index') }}">
                <i class="nc-icon nc-paper-2"></i>
                <p>Program Bansos</p>
            </a>
        </li>

        {{-- Penerima Bansos --}}
        <li class="{{ request()->routeIs('penerima-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('penerima-bansos.index') }}">
                <i class="nc-icon nc-badge"></i>
                <p>Penerima Bansos</p>
            </a>
        </li>

        {{-- Penyaluran Bansos --}}
        <li class="{{ request()->routeIs('penyaluran-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('penyaluran-bansos.index') }}">
                <i class="nc-icon nc-delivery-fast"></i>
                <p>Penyaluran Bansos</p>
            </a>
        </li>

        {{-- Donasi Management --}}
        <li class="{{ request()->routeIs('donasi.*') ? 'active' : '' }}">
            <a href="{{ route('donasi.index') }}">
                <i class="nc-icon nc-money-coins"></i>
                <p>Kelola Donasi</p>
            </a>
        </li>

        {{-- Bansos (Legacy) --}}
        <li class="{{ request()->routeIs('bansos.*') ? 'active' : '' }}">
            <a href="{{ route('bansos.index') }}">
                <i class="nc-icon nc-gift-2"></i>
                <p>Bansos Management</p>
            </a>
        </li>
    @endif

    {{-- ============================================ --}}
    {{-- STAFF ONLY MENU --}}
    {{-- ============================================ --}}
    @if(auth()->user()->isStaff())
        {{-- Verifikasi Penerima Bansos --}}
        <li class="{{ request()->routeIs('penerima-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('penerima-bansos.index') }}">
                <i class="nc-icon nc-badge"></i>
                <p>Verifikasi Penerima</p>
            </a>
        </li>

        {{-- Penyaluran Bansos --}}
        <li class="{{ request()->routeIs('penyaluran-bansos.*') ? 'active' : '' }}">
            <a href="{{ route('penyaluran-bansos.index') }}">
                <i class="nc-icon nc-delivery-fast"></i>
                <p>Penyaluran Bansos</p>
            </a>
        </li>

        {{-- Verifikasi Donasi --}}
        <li class="{{ request()->routeIs('donasi.*') ? 'active' : '' }}">
            <a href="{{ route('donasi.index') }}">
                <i class="nc-icon nc-check-2"></i>
                <p>Verifikasi Donasi</p>
            </a>
        </li>
    @endif

    {{-- ============================================ --}}
    {{-- USER / WARGA MENU --}}
    {{-- ============================================ --}}
    @if(auth()->check() && auth()->user()->role === 'user')
        {{-- Ajukan Bantuan --}}
        <li class="{{ request()->routeIs('donasi.user') ? 'active' : '' }}">
            <a href="{{ route('donasi.user') }}">
                <i class="nc-icon nc-paper-2"></i>
                <p>Ajukan Bantuan</p>
            </a>
        </li>
    @endif

</ul>
