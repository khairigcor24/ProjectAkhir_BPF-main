@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'SEJAHTERA', 'navName' => 'Home', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Welcome to SEJAHTERA Dashboard') }}</h4>
                            <p class="card-category">{{ __('Your dashboard home page') }}</p>
                        </div>
                        <div class="card-body">
                            <p>{{ __('Welcome! This is your home page.') }}</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-info">{{ __('Go to Dashboard') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




