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

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Program</th>
                                        <th>Kuota</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Tanggal Mulai</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($programBansos as $index => $program)
                                        <tr>
                                            <td>{{ $programBansos->firstItem() + $index }}</td>
                                            <td>
                                                <strong>{{ $program->nama_program }}</strong>
                                                @if($program->gambar)
                                                    <i class="fa fa-image text-info ml-2" title="Memiliki gambar"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $program->kuota }}
                                                <small class="text-muted">(Tersisa: {{ $program->kuota_tersisa }})</small>
                                            </td>
                                            <td>Rp {{ number_format($program->nominal_bantuan ?? 0, 0, ',', '.') }}</td>
                                            <td>
                                                @if($program->status == 'aktif')
                                                    <span class="badge badge-success">Aktif</span>
                                                @elseif($program->status == 'nonaktif')
                                                    <span class="badge badge-secondary">Nonaktif</span>
                                                @else
                                                    <span class="badge badge-info">Selesai</span>
                                                @endif
                                            </td>
                                            <td>{{ $program->tanggal_mulai->format('d/m/Y') }}</td>
                                            <td class="td-actions text-right">
                                                <a href="{{ route('program-bansos.show', $program) }}" rel="tooltip" title="View" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('program-bansos.edit', $program) }}" rel="tooltip" title="Edit" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('program-bansos.destroy', $program) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" rel="tooltip" title="Delete" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted">
                                        Menampilkan {{ $programBansos->firstItem() ?? 0 }} sampai {{ $programBansos->lastItem() ?? 0 }} dari {{ $programBansos->total() }} hasil
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right">
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
@endsection

