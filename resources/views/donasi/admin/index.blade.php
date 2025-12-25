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
                                    <p class="text-sm mb-0">{{ __('Halaman ini hanya dapat diakses oleh Admin') }}</p>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('donasi.create') }}" class="btn btn-sm btn-primary">{{ __('Tambah Donasi') }}</a>
                                    <a href="{{ route('donasi.laporan') }}" class="btn btn-sm btn-info">{{ __('Laporan') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @include('alerts.success', ['key' => 'success'])
                            @include('alerts.errors')

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('No') }}</th>
                                            <th>{{ __('Nama Donatur') }}</th>
                                            <th>{{ __('Jenis Donasi') }}</th>
                                            <th>{{ __('Jumlah/Deskripsi') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Tanggal') }}</th>
                                            <th>{{ __('Validator') }}</th>
                                            <th class="text-right">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($donasi as $index => $item)
                                            <tr>
                                                <td>{{ $donasi->firstItem() + $index }}</td>
                                                <td>{{ $item->nama_donatur }}</td>
                                                <td>
                                                    <span class="badge badge-info">{{ ucfirst($item->jenis_donasi) }}</span>
                                                </td>
                                                <td>
                                                    @if($item->jenis_donasi == 'uang')
                                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                                    @else
                                                        {{ Str::limit($item->deskripsi_barang, 50) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status == 'pending')
                                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                    @elseif($item->status == 'diterima')
                                                        <span class="badge badge-success">{{ __('Diterima') }}</span>
                                                    @elseif($item->status == 'ditolak')
                                                        <span class="badge badge-danger">{{ __('Ditolak') }}</span>
                                                    @elseif($item->status == 'selesai')
                                                        <span class="badge badge-primary">{{ __('Selesai') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->tanggal_donasi->format('d/m/Y') }}</td>
                                                <td>
                                                    @if($item->validator)
                                                        {{ $item->validator->name }}
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="td-actions text-right">
                                                    <a href="{{ route('donasi.show', $item) }}" rel="tooltip" title="{{ __('View') }}" class="btn btn-info btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('donasi.edit', $item) }}" rel="tooltip" title="{{ __('Edit') }}" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('donasi.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" rel="tooltip" title="{{ __('Delete') }}" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">{{ __('No data found') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="text-muted">
                                            {{ __('Showing') }} {{ $donasi->firstItem() ?? 0 }} {{ __('to') }} {{ $donasi->lastItem() ?? 0 }} {{ __('of') }} {{ $donasi->total() }} {{ __('results') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
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
    </div>
@endsection
