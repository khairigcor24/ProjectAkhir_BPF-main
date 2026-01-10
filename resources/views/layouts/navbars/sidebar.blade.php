<ul class="nav">

    {{-- SEMUA USER LOGIN --}}
    <li class="{{ $activePage == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <i class="nc-icon nc-chart-pie-35"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- ADMIN --}}
    @if(auth()->user()->isAdmin())
        <li class="{{ str_contains(request()->route()->getName(), 'user') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}">
                <i class="nc-icon nc-single-02"></i>
                <p>User Management</p>
            </a>
        </li>

        <li class="{{ str_contains(request()->route()->getName(), 'program-bansos') ? 'active' : '' }}">
            <a href="{{ route('program-bansos.index') }}">
                <i class="nc-icon nc-paper-2"></i>
                <p>Program Bansos</p>
            </a>
        </li>

        <li class="{{ str_contains(request()->route()->getName(), 'penerima-bansos') ? 'active' : '' }}">
            <a href="{{ route('penerima-bansos.index') }}">
                <i class="nc-icon nc-badge"></i>
                <p>Penerima Bansos</p>
            </a>
        </li>

        <li class="{{ str_contains(request()->route()->getName(), 'penyaluran-bansos') ? 'active' : '' }}">
            <a href="{{ route('penyaluran-bansos.index') }}">
                <i class="nc-icon nc-delivery-fast"></i>
                <p>Penyaluran Bansos</p>
            </a>
        </li>

        <li class="{{ str_contains(request()->route()->getName(), 'donasi') ? 'active' : '' }}">
            <a href="{{ route('donasi.index') }}">
                <i class="nc-icon nc-money-coins"></i>
                <p>Kelola Donasi</p>
            </a>
        </li>
    @endif

    {{-- STAFF --}}
    @if(auth()->user()->isStaff())
        <li class="{{ str_contains(request()->route()->getName(), 'penerima-bansos') ? 'active' : '' }}">
            <a href="{{ route('penerima-bansos.index') }}">
                <i class="nc-icon nc-badge"></i>
                <p>Verifikasi Penerima</p>
            </a>
        </li>

        <li class="{{ str_contains(request()->route()->getName(), 'penyaluran-bansos') ? 'active' : '' }}">
            <a href="{{ route('penyaluran-bansos.index') }}">
                <i class="nc-icon nc-delivery-fast"></i>
                <p>Penyaluran Bansos</p>
            </a>
        </li>

        <li class="{{ str_contains(request()->route()->getName(), 'donasi') ? 'active' : '' }}">
            <a href="{{ route('donasi.index') }}">
                <i class="nc-icon nc-check-2"></i>
                <p>Verifikasi Donasi</p>
            </a>
        </li>
    @endif

    {{-- USER / WARGA --}}
    @if(auth()->check() && auth()->user()->role === 'user')
        <li>
            <a href="{{ route('donasi.user') }}">
                <i class="nc-icon nc-paper-2"></i>
                <p>Ajukan Bantuan</p>
            </a>
        </li>
    @endif

</ul>
