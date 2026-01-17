@extends('layouts.app', ['activePage' => 'user-management', 'title' => 'SEJAHTERA', 'navName' => 'User Management', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card data-tables">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Users') }}</h3>
                                    <p class="mb-0 text-sm">
                                        {{ __('This is an example of user management. This is a minimal setup in order to get started fast.') }}
                                    </p>
                                </div>
                                <div class="text-right col-4">
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @include('alerts.success', ['key' => 'success'])
                            @include('alerts.errors')

                            <div class="mb-3 row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="perPage">{{ __('Show') }}</label>
                                        <select id="perPage" class="form-control" onchange="updatePerPage(this.value)">
                                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="search">{{ __('Search') }}</label>
                                        <form method="GET" action="{{ route('admin.users.index') }}" id="searchForm">
                                            @if(request('per_page'))
                                                <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                                            @endif
                                            <div class="input-group">
                                                <input type="text" id="search" name="search" class="form-control" placeholder="{{ __('Search by name or email...') }}" value="{{ request('search') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-default" type="submit">
                                                        <i class="nc-icon nc-zoom-split"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Role') }}</th>
                                            <th>{{ __('Start') }}</th>
                                            <th class="text-right">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                                <td class="text-right td-actions">
                                                    <a href="{{ route('admin.users.show', $user) }}" rel="tooltip" title="{{ __('View') }}" class="btn btn-info btn-sm">
                                                        {{ __('View') }}
                                                    </a>
                                                    <a href="{{ route('admin.users.edit', $user) }}" rel="tooltip" title="{{ __('Edit') }}" class="btn btn-warning btn-sm">
                                                        {{ __('Edit') }}
                                                    </a>
                                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this user?') }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" rel="tooltip" title="{{ __('Delete') }}" class="btn btn-danger btn-sm">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">{{ __('No users found.') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-muted">
                                            {{ __('Showing') }} {{ $users->firstItem() ?? 0 }} {{ __('to') }} {{ $users->lastItem() ?? 0 }} {{ __('of') }} {{ $users->total() }} {{ __('results') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="float-right">
                                            {{ $users->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function updatePerPage(value) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', value);
        if (url.searchParams.get('page')) {
            url.searchParams.set('page', '1');
        }
        window.location.href = url.toString();
    }
</script>
@endpush
