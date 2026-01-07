@extends('layouts.app', ['activePage' => 'admin-dashboard', 'title' => 'Admin Dashboard - SEJAHTERA', 'navName' => 'Admin Dashboard', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Admin Dashboard') }}</h4>
                            <p class="card-category">{{ __('Selamat datang di Dashboard Admin') }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="nc-icon nc-single-02"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Total Users') }}</p>
                                                        <h4 class="card-title">{{ \App\Models\User::count() }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-refresh"></i> {{ __('Updated now') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center icon-success">
                                                        <i class="nc-icon nc-money-coins"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Total Donasi') }}</p>
                                                        <h4 class="card-title">{{ \App\Models\Donasi::count() }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-calendar-o"></i> {{ __('Last month') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center icon-info">
                                                        <i class="nc-icon nc-check-2"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Donasi Validated') }}</p>
                                                        <h4 class="card-title">{{ \App\Models\Donasi::where('status', 'validated')->count() }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <hr>
                                            <div class="stats">
                                                <i class="fa fa-clock-o"></i> {{ __('In the last hour') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ __('Recent Activities') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-user-plus text-success"></i> New user registered</li>
                                                <li><i class="fa fa-money text-info"></i> Donation submitted</li>
                                                <li><i class="fa fa-check text-warning"></i> Donation validated</li>
                                                <li><i class="fa fa-edit text-danger"></i> User profile updated</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ __('Quick Actions') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-block">{{ __('Create New User') }}</a>
                                            <a href="{{ route('donasi.create') }}" class="btn btn-success btn-block">{{ __('Add Donation') }}</a>
                                            <a href="{{ route('donasi.laporan') }}" class="btn btn-info btn-block">{{ __('View Reports') }}</a>
                                            <a href="{{ route('user.index') }}" class="btn btn-warning btn-block">{{ __('Manage Users') }}</a>
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
