@extends('layouts.app', [
    'activePage' => 'dashboard',
    'title' => 'SEJAHTERA',
    'navName' => 'Dashboard',
    'activeButton' => 'laravel'
])

@section('content')
<div class="content">
    <div class="container-fluid">

        @switch(auth()->user()->role)
            @case('admin')
                @include('dashboard.admin')
                @break

            @case('staff')
                @include('dashboard.staff')
                @break

            @default
                @include('dashboard.guest')
        @endswitch

    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        demo.initDashboardPageCharts();
    });
</script>
@endpush
