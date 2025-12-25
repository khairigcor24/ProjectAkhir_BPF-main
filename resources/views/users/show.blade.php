@extends('layouts.app', ['activePage' => 'user-management', 'title' => 'SEJAHTERA', 'navName' => 'User Details', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('User Details') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Name') }}</label>
                                <p class="form-control-plaintext">{{ $user->name }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">{{ __('Email') }}</label>
                                <p class="form-control-plaintext">{{ $user->email }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">{{ __('Created At') }}</label>
                                <p class="form-control-plaintext">{{ $user->created_at->format('Y-m-d H:i:s') }}</p>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('user.index') }}" class="btn btn-default mt-4">{{ __('Back to List') }}</a>
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-primary mt-4">{{ __('Edit User') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
