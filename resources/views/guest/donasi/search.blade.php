@extends('layouts.app', ['activePage' => 'donasi', 'title' => 'SEJAHTERA', 'navName' => 'Cari Donasi'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Pencarian Donasi') }}</h4>
                            <p class="card-category">{{ __('Cari donasi yang telah diterima') }}</p>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('guest.donasi.search') }}" class="mb-4">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" name="q" class="form-control" placeholder="{{ __('Cari berdasarkan nama donatur atau deskripsi...') }}" value="{{ request('q') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="nc-icon nc-zoom-split"></i> {{ __('Cari') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                @forelse($donasi as $item)
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->nama_donatur }}</h5>
                                                <p class="card-text">
                                                    <strong>{{ __('Jenis:') }}</strong> 
                                                    <span class="badge badge-info">{{ ucfirst($item->jenis_donasi) }}</span>
                                                </p>
                                                @if($item->jenis_donasi == 'uang')
                                                    <p class="card-text">
                                                        <strong>{{ __('Jumlah:') }}</strong> 
                                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                                    </p>
                                                @else
                                                    <p class="card-text">
                                                        <strong>{{ __('Deskripsi:') }}</strong> 
                                                        {{ Str::limit($item->deskripsi_barang, 100) }}
                                                    </p>
                                                @endif
                                                <p class="card-text">
                                                    <small class="text-muted">{{ __('Tanggal:') }} {{ $item->tanggal_donasi->format('d/m/Y') }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12">
                                        <div class="alert alert-info">{{ __('Tidak ada donasi yang ditemukan') }}</div>
                                    </div>
                                @endforelse
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        {{ $donasi->links() }}
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <a href="{{ route('guest.donasi.create') }}" class="btn btn-primary">{{ __('Daftar Donasi') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



