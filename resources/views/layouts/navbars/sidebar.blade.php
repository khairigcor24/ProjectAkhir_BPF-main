<ul class="nav">

    {{-- SEMUA USER LOGIN --}}
    <li class="{{ $activePage == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <i class="nc-icon nc-chart-pie-35"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- ADMIN --}}
    @role('admin')
        <li>
            <a href="{{ route('user.index') }}">
                <i class="nc-icon nc-single-02"></i>
                <p>User Management</p>
            </a>
        </li>

        <li>
            <a href="{{ route('donasi.index') }}">
                <i class="nc-icon nc-money-coins"></i>
                <p>Kelola Donasi</p>
            </a>
        </li>
    @endrole

    {{-- STAFF --}}
    @role('staff')
        <li>
            <a href="{{ route('donasi.index') }}">
                <i class="nc-icon nc-check-2"></i>
                <p>Verifikasi Donasi</p>
            </a>
        </li>
    @endrole

    {{-- USER / WARGA --}}
    @role('user')
        <li>
            <a href="{{ route('donasi.public') }}">
                <i class="nc-icon nc-paper-2"></i>
                <p>Ajukan Bantuan</p>
            </a>
        </li>
    @endrole

</ul>
