@if (auth()->check() && request()->route()->getName() != null)
    @include('partials.navbars.navs.auth')
@else
    @include('partials.navbars.navs.guest')
@endif