@extends('layouts.app', ['activePage' => 'donasi', 'title' => 'SEJAHTERA', 'navName' => 'Laporan Donasi', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Laporan Donasi') }}</h4>
                            <p class="card-category">{{ __('Statistik dan Ringkasan Donasi') }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="nc-icon nc-paper text-warning"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Total Donasi') }}</p>
                                                        <p class="card-title">{{ $totalDonasi }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="nc-icon nc-time-alarm text-warning"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Pending') }}</p>
                                                        <p class="card-title">{{ $donasiPending }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div class="icon-big text-center icon-success">
                                                        <i class="nc-icon nc-check-2 text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Diterima') }}</p>
                                                        <p class="card-title">{{ $donasiDiterima }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5 col-md-4">
                                                    <div class="icon-big text-center icon-danger">
                                                        <i class="nc-icon nc-simple-remove text-danger"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-md-8">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Ditolak') }}</p>
                                                        <p class="card-title">{{ $donasiDitolak }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Total Donasi Uang (Diterima)') }}</p>
                                                        <h3 class="card-title">Rp {{ number_format($totalUang, 0, ',', '.') }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="numbers">
                                                        <p class="card-category">{{ __('Selesai') }}</p>
                                                        <h3 class="card-title">{{ $donasiSelesai }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('donasi.index') }}" class="btn btn-default">{{ __('Kembali') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
