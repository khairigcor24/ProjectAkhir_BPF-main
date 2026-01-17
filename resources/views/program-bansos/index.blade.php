@extends('layouts.app', ['activePage' => 'program-bansos', 'title' => 'Program Bansos', 'navName' => 'Program Bansos', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Program Bansos</h3>
                                <p class="text-sm mb-0">Kelola program bantuan sosial</p>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('program-bansos.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Tambah Program
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('alerts.success')
                        @include('alerts.errors')

                        {{-- Search dan Filter --}}
                        <form method="GET" action="{{ route('program-bansos.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari program..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
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

                        {{-- Program Cards Grid View --}}
                        @forelse($programBansos as $program)
                            @if($loop->first)
                                <div class="row">
                            @endif

                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm hover-shadow transition" style="cursor: pointer; transition: all 0.3s ease;">
                                    {{-- Program Image --}}
                                    @if($program->gambar)
                                        <img src="{{ asset('storage/' . $program->gambar) }}" alt="{{ $program->nama_program }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="fa fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $program->nama_program }}</h5>
                                        
                                        <p class="card-text text-muted small flex-grow-1">
                                            {{ Str::limit($program->deskripsi, 100, '...') }}
                                        </p>

                                        <div class="mb-3">
                                            {{-- Status Badge --}}
                                            <div class="mb-2">
                                                @if($program->status == 'aktif')
                                                    <span class="badge badge-success">Aktif</span>
                                                @elseif($program->status == 'nonaktif')
                                                    <span class="badge badge-secondary">Nonaktif</span>
                                                @else
                                                    <span class="badge badge-info">Selesai</span>
                                                @endif
                                            </div>

                                            {{-- Quota Info --}}
                                            <small class="text-muted">
                                                <i class="fa fa-users"></i> Kuota: {{ $program->kuota_tersisa }}/{{ $program->kuota }} tersisa
                                            </small>
                                            <br>

                                            {{-- Nominal --}}
                                            <strong class="text-primary">
                                                Rp {{ number_format($program->nominal_bantuan ?? 0, 0, ',', '.') }}
                                            </strong>
                                        </div>

                                        {{-- Action Buttons --}}
                                        <div class="btn-group btn-group-sm w-100" role="group">
                                            <a href="{{ route('program-bansos.show', $program) }}" class="btn btn-info" title="Lihat Detail">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @can('is-admin')
                                            <a href="{{ route('program-bansos.edit', $program) }}" class="btn btn-warning" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger" onclick="deleteProgram({{ $program->id }})" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                        </div>

                                        {{-- Hidden Form for Delete --}}
                                        @can('is-admin')
                                        <form id="delete-form-{{ $program->id }}" action="{{ route('program-bansos.destroy', $program) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>

                            @if($loop->last)
                                </div>
                            @elseif(($loop->index + 1) % 3 == 0)
                                </div>
                                <div class="row">
                            @endif

                        @empty
                            <div class="alert alert-info text-center" role="alert">
                                <i class="fa fa-info-circle"></i> Tidak ada program bansos yang ditemukan
                            </div>
                        @endforelse

                        {{-- Pagination --}}
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted mb-0">
                                        Menampilkan {{ $programBansos->firstItem() ?? 0 }} sampai {{ $programBansos->lastItem() ?? 0 }} dari {{ $programBansos->total() }} hasil
                                    </p>
                                    <div>
                                        {{ $programBansos->links() }}
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

<style>
    .transition {
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-2px);
    }

    .btn-group-sm .btn {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }
</style>

<script>
    function deleteProgram(programId) {
        if (confirm('Apakah Anda yakin ingin menghapus program ini?')) {
            document.getElementById('delete-form-' + programId).submit();
        }
    }
</script>
@endsection





