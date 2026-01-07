@extends('layouts.public', ['title' => 'Program Bansos'])

@section('content')
<style>
    .program-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 30px;
        height: 100%;
    }
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .program-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
    .badge-status {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>

<div class="container" style="padding-top: 100px; min-height: 100vh;">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Program Bantuan Sosial</h2>
            <p class="text-center text-muted">Temukan program bantuan sosial yang sesuai dengan kebutuhan Anda</p>
        </div>
    </div>

    {{-- Search dan Filter --}}
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('guest.program-bansos.index') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari program bansos..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="date" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" value="{{ request('tanggal_mulai') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fa fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Program Cards --}}
    <div class="row">
        @forelse($programBansos as $program)
            <div class="col-md-4 mb-4">
                <div class="card program-card">
                    @if($program->gambar)
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $program->gambar) }}" alt="{{ $program->nama_program }}" class="program-image card-img-top">
                            <span class="badge badge-success badge-status">Aktif</span>
                        </div>
                    @else
                        <div class="position-relative" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <span class="badge badge-success badge-status">Aktif</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $program->nama_program }}</h5>
                        <p class="card-text">{{ Str::limit($program->deskripsi, 100) }}</p>
                        
                        <div class="mb-3">
                            <p class="mb-1">
                                <strong>Kuota:</strong> {{ $program->kuota }} penerima
                                <span class="badge badge-info ml-2">Tersisa: {{ $program->kuota_tersisa }}</span>
                            </p>
                            @if($program->nominal_bantuan)
                                <p class="mb-1">
                                    <strong>Nominal:</strong> Rp {{ number_format($program->nominal_bantuan, 0, ',', '.') }}
                                </p>
                            @endif
                            <p class="mb-1">
                                <strong>Periode:</strong> {{ $program->tanggal_mulai->format('d/m/Y') }} 
                                @if($program->tanggal_selesai)
                                    - {{ $program->tanggal_selesai->format('d/m/Y') }}
                                @endif
                            </p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('guest.program-bansos.show', $program) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-info-circle"></i> Detail
                            </a>
                            @if($program->hasQuota())
                                <a href="{{ route('guest.penerima-bansos.create') }}?program={{ $program->id }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil-alt"></i> Daftar
                                </a>
                            @else
                                <span class="badge badge-warning">Kuota Penuh</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <div class="alert alert-info text-center">
                    <i class="fa fa-info-circle fa-2x mb-2"></i>
                    <p>Tidak ada program bansos yang tersedia saat ini.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($programBansos->hasPages())
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                {{ $programBansos->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection


