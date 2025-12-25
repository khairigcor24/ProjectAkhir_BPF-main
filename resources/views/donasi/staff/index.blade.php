@extends('layouts.app', ['activePage' => 'donasi', 'title' => 'SEJAHTERA', 'navName' => 'Manajemen Donasi', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Manajemen Donasi') }}</h3>
                                    <p class="text-sm mb-0">{{ __('Halaman ini untuk Staff - Validasi dan Lihat Laporan') }}</p>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('donasi.laporan') }}" class="btn btn-sm btn-info">{{ __('Laporan') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @include('alerts.success', ['key' => 'success'])
                            @include('alerts.errors')

                            <div class="row">
                                @forelse($donasi as $item)
                                    <div class="col-md-4 mb-4">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="numbers">
                                                            <p class="card-category">{{ __('Nama Donatur') }}</p>
                                                            <h4 class="card-title">{{ $item->nama_donatur }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><strong>{{ __('Jenis:') }}</strong> 
                                                            <span class="badge badge-info">{{ ucfirst($item->jenis_donasi) }}</span>
                                                        </p>
                                                        <p><strong>{{ __('Jumlah/Deskripsi:') }}</strong>
                                                            @if($item->jenis_donasi == 'uang')
                                                                <br>Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                                            @else
                                                                <br>{{ Str::limit($item->deskripsi_barang, 100) }}
                                                            @endif
                                                        </p>
                                                        <p><strong>{{ __('Status:') }}</strong>
                                                            @if($item->status == 'pending')
                                                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                            @elseif($item->status == 'diterima')
                                                                <span class="badge badge-success">{{ __('Diterima') }}</span>
                                                            @elseif($item->status == 'ditolak')
                                                                <span class="badge badge-danger">{{ __('Ditolak') }}</span>
                                                            @elseif($item->status == 'selesai')
                                                                <span class="badge badge-primary">{{ __('Selesai') }}</span>
                                                            @endif
                                                        </p>
                                                        <p><strong>{{ __('Tanggal:') }}</strong> {{ $item->tanggal_donasi->format('d/m/Y') }}</p>
                                                        @if($item->validator)
                                                            <p><strong>{{ __('Validator:') }}</strong> {{ $item->validator->name }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <a href="{{ route('donasi.show', $item) }}" class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye"></i> {{ __('Detail') }}
                                                    </a>
                                                    @if($item->status == 'pending')
                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#validateModal{{ $item->id }}">
                                                            <i class="fa fa-check"></i> {{ __('Validasi') }}
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Validasi -->
                                    @if($item->status == 'pending')
                                        <div class="modal fade" id="validateModal{{ $item->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('donasi.validate', $item) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{ __('Validasi Donasi') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>{{ __('Status') }}</label>
                                                                <select name="status" class="form-control" required>
                                                                    <option value="diterima">{{ __('Diterima') }}</option>
                                                                    <option value="ditolak">{{ __('Ditolak') }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>{{ __('Catatan') }}</label>
                                                                <textarea name="catatan" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Batal') }}</button>
                                                            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="col-md-12">
                                        <div class="alert alert-info">{{ __('No data found') }}</div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
