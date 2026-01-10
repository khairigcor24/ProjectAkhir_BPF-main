@extends('layouts.app', ['activePage' => 'penerima-bansos', 'title' => 'Penerima Bansos', 'navName' => 'Penerima Bansos', 'activeButton' => 'laravel'])

@push('css')
<style>
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
}

.status-icon {
    text-align: center;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.avatar-circle {
    transition: all 0.3s ease;
}

.hover-card:hover .avatar-circle {
    background-color: #e3f2fd !important;
    transform: scale(1.1);
}

.card-footer .btn {
    transition: all 0.3s ease;
}

.card-footer .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}
</style>
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Penerima Bansos</h3>
                                <p class="mb-0 text-sm">Verifikasi dan kelola penerima bansos</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('alerts.success')
                        @include('alerts.errors')

                        {{-- Search dan Filter --}}
                        <form method="GET" action="{{ route('penerima-bansos.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari nama/NIK/alamat..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="program_bansos_id" class="form-control">
                                            <option value="">Semua Program</option>
                                            @foreach($programBansos as $program)
                                                <option value="{{ $program->id }}" {{ request('program_bansos_id') == $program->id ? 'selected' : '' }}>
                                                    {{ $program->nama_program }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="status_verifikasi" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="pending" {{ request('status_verifikasi') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="diterima" {{ request('status_verifikasi') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                            <option value="ditolak" {{ request('status_verifikasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>

                        {{-- Card View --}}
                        <div class="row">
                            @forelse($penerimaBansos as $penerima)
                                <div class="mb-4 col-md-6">
                                    <div class="border-0 shadow-lg card hover-card" style="transition: all 0.3s ease; border-radius: 15px; overflow: hidden;">
                                        <div class="text-white card-header bg-gradient-primary" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h5 class="mb-0 font-weight-bold">{{ $penerima->nama_lengkap }}</h5>
                                                    <small class="opacity-75">NIK: {{ $penerima->nik }}</small>
                                                </div>
                                                <div class="text-right col-4">
                                                    @if($penerima->status_verifikasi == 'pending')
                                                        <div class="status-icon">
                                                            <i class="fas fa-clock fa-2x text-warning"></i>
                                                            <span class="mt-1 badge badge-warning badge-pill">Pending</span>
                                                        </div>
                                                    @elseif($penerima->status_verifikasi == 'diterima')
                                                        <div class="status-icon">
                                                            <i class="fas fa-check-circle fa-2x text-success"></i>
                                                            <span class="mt-1 badge badge-success badge-pill">Diterima</span>
                                                        </div>
                                                    @else
                                                        <div class="status-icon">
                                                            <i class="fas fa-times-circle fa-2x text-danger"></i>
                                                            <span class="mt-1 badge badge-danger badge-pill">Ditolak</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="text-center col-3">
                                                    <div class="avatar-circle bg-light" style="width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                                        <i class="fas fa-user fa-2x text-primary"></i>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <p class="mb-1"><strong class="text-primary">Program:</strong> {{ $penerima->programBansos->nama_program }}</p>
                                                    <p class="mb-1"><strong class="text-primary">Alamat:</strong> {{ Str::limit($penerima->alamat, 30) }}</p>
                                                    <p class="mb-1"><strong class="text-primary">Telepon:</strong> {{ $penerima->telepon ?? '-' }}</p>
                                                    @if($penerima->dokumen_pendukung)
                                                        <p class="mb-1">
                                                            <strong class="text-primary">Dokumen:</strong>
                                                            <span class="badge badge-info badge-pill">{{ count($penerima->dokumen_pendukung) }} file</span>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                            <p class="mb-0 text-muted small">
                                                <i class="fas fa-calendar-alt text-muted"></i> Didaftarkan: {{ $penerima->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        <div class="border-0 card-footer bg-light">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="{{ route('penerima-bansos.show', $penerima) }}" class="btn btn-outline-info btn-sm btn-block">
                                                        <i class="fas fa-eye"></i> Lihat Detail
                                                    </a>
                                                </div>
                                                @if($penerima->status_verifikasi == 'pending')
                                                    <div class="col-6">
                                                        <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#verifyModal{{ $penerima->id }}">
                                                            <i class="fas fa-check"></i> Verifikasi
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="col-6">
                                                        <span class="text-muted small">
                                                            <i class="fas fa-check-double"></i> Sudah diverifikasi
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Verifikasi --}}
                                @if($penerima->status_verifikasi == 'pending')
                                <div class="modal fade" id="verifyModal{{ $penerima->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST"
                                                action="{{ route('penerima-bansos.verifikasi', $penerima->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Verifikasi Penerima Bansos</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama:</strong> {{ $penerima->nama_lengkap }}</p>
                                                    <p><strong>Program:</strong> {{ $penerima->programBansos->nama_program }}</p>
                                                    
                                                    <div class="form-group">
                                                        <label>Status Verifikasi <span class="text-danger">*</span></label>
                                                        <select name="status_verifikasi" class="form-control" required>
                                                            <option value="diterima">Diterima</option>
                                                            <option value="ditolak">Ditolak</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Catatan</label>
                                                        <textarea name="catatan_verifikasi" class="form-control" rows="3" placeholder="Catatan verifikasi (opsional)">{{ old('catatan_verifikasi', $penerima->catatan_verifikasi) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @empty
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i> Tidak ada data penerima bansos
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted">
                                        Menampilkan {{ $penerimaBansos->firstItem() ?? 0 }} sampai {{ $penerimaBansos->lastItem() ?? 0 }} dari {{ $penerimaBansos->total() }} hasil
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right">
                                        {{ $penerimaBansos->links() }}
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




