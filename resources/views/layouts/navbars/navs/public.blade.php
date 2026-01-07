<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="z-index: 1050;">
    <div class="container">
        <a class="navbar-brand" href="/" style="pointer-events: auto; cursor: pointer;">
            <i class="fas fa-hands-helping mr-2"></i>SEJAHTERA
        </a>

        <button class="navbar-toggler" type="button"
                data-toggle="collapse"
                data-target="#publicNavbar"
                aria-controls="publicNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
                style="pointer-events: auto;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="publicNavbar">
            <ul class="navbar-nav" style="pointer-events: auto;">
                <li class="nav-item">
                    <a class="nav-link" href="/" style="cursor: pointer; pointer-events: auto;">
                        <i class="fas fa-home mr-1"></i>Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.program-bansos.index') }}" style="cursor: pointer; pointer-events: auto;">
                        <i class="fas fa-info-circle mr-1"></i>Info Bansos
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="cursor: pointer; pointer-events: auto;">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-warning text-dark ml-2"
                           href="{{ route('register') }}"
                           style="cursor: pointer; pointer-events: auto; border-radius: 20px;">
                            <i class="fas fa-user-plus mr-1"></i>Register
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}" style="cursor: pointer; pointer-events: auto;">
                            <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="cursor: pointer; pointer-events: auto; color: rgba(255,255,255,.5); border: none; padding: 0.5rem 1rem;">
                                <i class="fas fa-sign-out-alt mr-1"></i>Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
