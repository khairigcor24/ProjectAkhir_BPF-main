@extends('layouts.app', ['activePage' => 'donasi', 'title' => 'SEJAHTERA', 'navName' => 'Detail Donasi', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Detail Donasi') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-control-label"><strong>{{ __('Nama Donatur') }}</strong></label>
                                <p class="form-control-plaintext">{{ $donasi->nama_donatur }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label"><strong>{{ __('Email') }}</strong></label>
                                <p class="form-control-plaintext">{{ $donasi->email ?? '-' }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label"><strong>{{ __('Telepon') }}</strong></label>
                                <p class="form-control-plaintext">{{ $donasi->telepon ?? '-' }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label"><strong>{{ __('Alamat') }}</strong></label>
                                <p class="form-control-plaintext">{{ $donasi->alamat ?? '-' }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label"><strong>{{ __('Jenis Donasi') }}</strong></label>
                                <p class="form-control-plaintext">
                                    <span class="badge badge-info">{{ ucfirst($donasi->jenis_donasi) }}</span>
                                </p>
                            </div>

                            @if($donasi->jenis_donasi == 'uang')
                                <div class="form-group">
                                    <label class="form-control-label"><strong>{{ __('Jumlah') }}</strong></label>
                                    <p class="form-control-plaintext">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</p>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="form-control-label"><strong>{{ __('Deskripsi Barang') }}</strong></label>
                                    <p class="form-control-plaintext">{{ $donasi->deskripsi_barang ?? '-' }}</p>
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="form-control-label"><strong>{{ __('Status') }}</strong></label>
                                <p class="form-control-plaintext">
                                    @if($donasi->status == 'pending')
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @elseif($donasi->status == 'diterima')
                                        <span class="badge badge-success">{{ __('Diterima') }}</span>
                                    @elseif($donasi->status == 'ditolak')
                                        <span class="badge badge-danger">{{ __('Ditolak') }}</span>
                                    @elseif($donasi->status == 'selesai')
                                        <span class="badge badge-primary">{{ __('Selesai') }}</span>
                                    @endif
                                </p>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label"><strong>{{ __('Catatan') }}</strong></label>
                                <p class="form-control-plaintext">{{ $donasi->catatan ?? '-' }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label"><strong>{{ __('Tanggal Donasi') }}</strong></label>
                                <p class="form-control-plaintext">{{ $donasi->tanggal_donasi->format('d/m/Y H:i') }}</p>
                            </div>

                            @if($donasi->validator)
                                <div class="form-group">
                                    <label class="form-control-label"><strong>{{ __('Divalidasi Oleh') }}</strong></label>
                                    <p class="form-control-plaintext">{{ $donasi->validator->name }}</p>
                                </div>
                            @endif

                            <div class="text-center">
                                <a href="{{ route('donasi.index') }}" class="btn btn-default mt-4">{{ __('Kembali') }}</a>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('donasi.edit', $donasi) }}" class="btn btn-primary mt-4">{{ __('Edit') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
