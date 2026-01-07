@if(Auth::check())
    @include('layouts.navbars.navs.auth')
@else
    @include('layouts.navbars.navs.public')
@endif
