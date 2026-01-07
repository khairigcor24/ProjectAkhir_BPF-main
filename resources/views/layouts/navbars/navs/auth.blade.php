<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>
    </li>

    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="nav-link btn btn-link">Logout</button>
        </form>
    </li>
</ul>
