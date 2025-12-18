@extends('layouts.app', ['activePage' => 'user-management', 'title' => 'User Details', 'navName' => 'User Details', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">User Details</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <p class="form-control-static text-dark">{{ $user->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <p class="form-control-static text-dark">{{ $user->email }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Created At</label>
                                    <p class="form-control-static text-dark">{{ $user->created_at->format('d/m/Y H:i:s') }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Last Updated</label>
                                    <p class="form-control-static text-dark">{{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
                                </div>

                                <div class="text-center">
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-warning mt-4">Edit User</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
