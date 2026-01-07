@extends('layouts.app', ['activePage' => 'penerima-bansos', 'title' => 'Penerima Bansos', 'navName' => 'Penerima Bansos', 'activeButton' => 'laravel'])

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
                                <p class="text-sm mb-0">Verifikasi dan kelola penerima bansos</p>
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
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h5 class="mb-0">{{ $penerima->nama_lengkap }}</h5>
                                                    <small class="text-muted">NIK: {{ $penerima->nik }}</small>
                                                </div>
                                                <div class="col-4 text-right">
                                                    @if($penerima->status_verifikasi == 'pending')
                                                        <span class="badge badge-warning badge-lg">Pending</span>
                                                    @elseif($penerima->status_verifikasi == 'diterima')
                                                        <span class="badge badge-success badge-lg">Diterima</span>
                                                    @else
                                                        <span class="badge badge-danger badge-lg">Ditolak</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Program:</strong> {{ $penerima->programBansos->nama_program }}</p>
                                            <p><strong>Alamat:</strong> {{ $penerima->alamat }}</p>
                                            <p><strong>Telepon:</strong> {{ $penerima->telepon ?? '-' }}</p>
                                            @if($penerima->dokumen_pendukung)
                                                <p>
                                                    <strong>Dokumen:</strong> 
                                                    <span class="badge badge-info">{{ count($penerima->dokumen_pendukung) }} file</span>
                                                </p>
                                            @endif
                                            <p class="text-muted small">
                                                <i class="fa fa-calendar"></i> Didaftarkan: {{ $penerima->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('penerima-bansos.show', $penerima) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i> Lihat Detail
                                            </a>
                                            @if($penerima->status_verifikasi == 'pending')
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#verifyModal{{ $penerima->id }}">
                                                    <i class="fa fa-check"></i> Verifikasi
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Verifikasi --}}
                                @if($penerima->status_verifikasi == 'pending')
                                <div class="modal fade" id="verifyModal{{ $penerima->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('penerima-bansos.verify', $penerima) }}" method="POST">
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



