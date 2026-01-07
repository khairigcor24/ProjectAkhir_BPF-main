<nav class="navbar navbar-expand-lg navbar-transparent fixed-top">
    <div class="container">
        <a class="navbar-brand text-white" href="/">
            SEJAHTERA
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#publicNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="publicNavbar">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link text-white" href="/">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="/donasi">
                        Info Bansos
                    </a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-warning text-dark ml-2"
                           href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
