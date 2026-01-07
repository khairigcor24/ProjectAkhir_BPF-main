{{-- Public guest --}}
@guest
<li>
    <a href="/bansos">Info Bansos</a>
</li>
<li>
    <a href="/login">Login</a>
</li>
@endguest

{{-- Guest login --}}
@auth
@if(auth()->user()->role === 'guest')
<li>
    <a href="/dashboard">Dashboard</a>
</li>
<li>
    <a href="/pengajuan">Ajukan Bansos</a>
</li>
<li>
    <a href="/status">Status</a>
</li>
@endif
@endauth
