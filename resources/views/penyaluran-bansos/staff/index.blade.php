@extends('layouts.app', ['activePage' => 'penyaluran-bansos', 'title' => 'Penyaluran Bansos', 'navName' => 'Penyaluran Bansos', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Penyaluran Bansos</h3>
                                <p class="text-sm mb-0">Kelola penyaluran bantuan sosial</p>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('penyaluran-bansos.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Tambah Penyaluran
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('alerts.success')
                        @include('alerts.errors')

                        {{-- Filter --}}
                        <form method="GET" action="{{ route('penyaluran-bansos.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="text" name="search" class="form-control" placeholder="Cari nama/NIK..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="status" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="dijadwalkan" {{ request('status') == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="disalurkan" {{ request('status') == 'disalurkan' ? 'selected' : '' }}>Disalurkan</option>
                                        <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                    </select>
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
                            @forelse($penyaluranBansos as $penyaluran)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h5 class="mb-0">{{ $penyaluran->penerimaBansos->nama_lengkap }}</h5>
                                                    <small class="text-muted">NIK: {{ $penyaluran->penerimaBansos->nik }}</small>
                                                </div>
                                                <div class="col-4 text-right">
                                                    @if($penyaluran->status == 'dijadwalkan')
                                                        <span class="badge badge-secondary badge-lg">Dijadwalkan</span>
                                                    @elseif($penyaluran->status == 'diproses')
                                                        <span class="badge badge-warning badge-lg">Diproses</span>
                                                    @elseif($penyaluran->status == 'disalurkan')
                                                        <span class="badge badge-success badge-lg">Disalurkan</span>
                                                    @else
                                                        <span class="badge badge-danger badge-lg">Gagal</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Program:</strong> {{ $penyaluran->programBansos->nama_program }}</p>
                                            <p><strong>Nominal:</strong> Rp {{ number_format($penyaluran->nominal_diterima, 0, ',', '.') }}</p>
                                            <p><strong>Metode:</strong> {{ ucfirst($penyaluran->metode_penyaluran) }}</p>
                                            @if($penyaluran->metode_penyaluran == 'transfer')
                                                <p><strong>Rekening:</strong> {{ $penyaluran->no_rekening ?? '-' }} ({{ $penyaluran->nama_bank ?? '-' }})</p>
                                            @endif
                                            <p class="text-muted small">
                                                <i class="fa fa-calendar"></i> Tanggal: {{ $penyaluran->tanggal_penyaluran->format('d/m/Y') }}
                                            </p>
                                            @if($penyaluran->catatan)
                                                <p><strong>Catatan:</strong> {{ $penyaluran->catatan }}</p>
                                            @endif
                                        </div>
                                        <div class="card-footer">
                                            <a href="{{ route('penyaluran-bansos.show', $penyaluran) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i> Detail
                                            </a>
                                            <a href="{{ route('penyaluran-bansos.edit', $penyaluran) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i> Tidak ada data penyaluran bansos
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted">
                                        Menampilkan {{ $penyaluranBansos->firstItem() ?? 0 }} sampai {{ $penyaluranBansos->lastItem() ?? 0 }} dari {{ $penyaluranBansos->total() }} hasil
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right">
                                        {{ $penyaluranBansos->links() }}
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


