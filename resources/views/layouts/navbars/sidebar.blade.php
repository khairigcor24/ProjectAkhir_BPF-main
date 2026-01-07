@auth
    @switch(auth()->user()->role)
        @case('admin')
            @include('navbars.sidebar.admin')
            @break

        @case('staff')
            @include('navbars.sidebar.staff')
            @break

        @default
            @include('navbars.sidebar.guest')
    @endswitch
@endauth
