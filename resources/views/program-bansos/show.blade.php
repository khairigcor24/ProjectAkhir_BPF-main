@extends('layouts.app', ['activePage' => 'program-bansos', 'title' => 'Detail Program Bansos', 'navName' => 'Detail Program', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="card-title">{{ $programBansos->nama_program }}</h4>
                                <p class="card-category">Detail Program Bansos</p>
                            </div>
                            <div class="col-4 text-right">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('program-bansos.edit', $programBansos) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($programBansos->gambar)
                            <div class="text-center mb-3">
                                <img src="{{ asset('storage/' . $programBansos->gambar) }}" alt="{{ $programBansos->nama_program }}" class="img-fluid rounded" style="max-height: 300px;">
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Program</th>
                                <td>{{ $programBansos->nama_program }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $programBansos->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th>Kuota</th>
                                <td>
                                    {{ $programBansos->kuota }} penerima
                                    <span class="badge badge-info ml-2">Tersisa: {{ $programBansos->kuota_tersisa }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Nominal Bantuan</th>
                                <td>Rp {{ number_format($programBansos->nominal_bantuan ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <td>{{ $programBansos->tanggal_mulai->format('d/m/Y') }}</td>
                            </tr>
                            @if($programBansos->tanggal_selesai)
                            <tr>
                                <th>Tanggal Selesai</th>
                                <td>{{ $programBansos->tanggal_selesai->format('d/m/Y') }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($programBansos->status == 'aktif')
                                        <span class="badge badge-success">Aktif</span>
                                    @elseif($programBansos->status == 'nonaktif')
                                        <span class="badge badge-secondary">Nonaktif</span>
                                    @else
                                        <span class="badge badge-info">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat Oleh</th>
                                <td>{{ $programBansos->creator->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>{{ $programBansos->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>

                        <div class="card-footer">
                            <a href="{{ route('program-bansos.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




