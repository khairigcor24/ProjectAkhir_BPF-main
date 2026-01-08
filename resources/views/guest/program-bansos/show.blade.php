@extends('layouts.public', ['title' => $programBansos->nama_program])

@section('content')
<div class="container" style="padding-top: 100px; min-height: 100vh;">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                @if($programBansos->gambar)
                <img src="{{ asset('storage/' . $programBansos->gambar) }}" alt="{{ $programBansos->nama_program }}" class="card-img-top" style="max-height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge badge-success badge-lg">Program Aktif</span>
                        @if($programBansos->hasQuota())
                            <span class="badge badge-info badge-lg">Kuota Tersedia: {{ $kuotaTersisa }}</span>
                        @else
                            <span class="badge badge-warning badge-lg">Kuota Penuh</span>
                        @endif
                    </div>

                    <h2 class="card-title">{{ $programBansos->nama_program }}</h2>
                    
                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong><i class="fa fa-users"></i> Kuota:</strong> {{ $programBansos->kuota }} penerima</p>
                            <p><strong><i class="fa fa-check-circle"></i> Terdaftar:</strong> {{ $penerimaDiterima }} penerima</p>
                            <p><strong><i class="fa fa-info-circle"></i> Tersisa:</strong> {{ $kuotaTersisa }} kuota</p>
                        </div>
                        <div class="col-md-6">
                            @if($programBansos->nominal_bantuan)
                                <p><strong><i class="fa fa-money-bill"></i> Nominal:</strong> Rp {{ number_format($programBansos->nominal_bantuan, 0, ',', '.') }}</p>
                            @endif
                            <p><strong><i class="fa fa-calendar"></i> Mulai:</strong> {{ $programBansos->tanggal_mulai->format('d/m/Y') }}</p>
                            @if($programBansos->tanggal_selesai)
                                <p><strong><i class="fa fa-calendar-check"></i> Selesai:</strong> {{ $programBansos->tanggal_selesai->format('d/m/Y') }}</p>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h5>Deskripsi Program</h5>
                    <p class="card-text">{{ $programBansos->deskripsi }}</p>

                    <hr>

                    <div class="text-center mt-4">
                        @if($programBansos->hasQuota())
                            <a href="{{ route('guest.penerima-bansos.create') }}?program={{ $programBansos->id }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-pencil-alt"></i> Daftar Sekarang
                            </a>
                        @else
                            <div class="alert alert-warning">
                                <i class="fa fa-exclamation-triangle"></i> Maaf, kuota program ini sudah penuh.
                            </div>
                        @endif
                        <a href="{{ route('guest.program-bansos.index') }}" class="btn btn-secondary btn-lg ml-2">
                            <i class="fa fa-arrow-left"></i> Kembali ke Daftar Program
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




