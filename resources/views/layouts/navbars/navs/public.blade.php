<ul class="navbar-nav ml-auto">

    {{-- PUBLIC (BELUM LOGIN) --}}
    @guest
        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/bansos">Info Bansos</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/statistik">Statistik</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
        </li>
    @endguest


    {{-- SUDAH LOGIN --}}
    @auth
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">Dashboard</a>
        </li>

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link">
                    Logout
                </button>
            </form>
        </li>
    @endauth

</ul>
