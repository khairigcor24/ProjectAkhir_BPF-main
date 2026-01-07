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
                                <p class="text-sm mb-0">Daftar penerima bantuan sosial</p>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('penerima-bansos.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i> Tambah Penerima
                                </a>
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

                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Program</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Tanggal Daftar</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($penerimaBansos as $index => $penerima)
                                        <tr>
                                            <td>{{ $penerimaBansos->firstItem() + $index }}</td>
                                            <td>{{ $penerima->nama_lengkap }}</td>
                                            <td>{{ $penerima->nik }}</td>
                                            <td>{{ $penerima->programBansos->nama_program }}</td>
                                            <td>{{ Str::limit($penerima->alamat, 30) }}</td>
                                            <td>
                                                @if($penerima->status_verifikasi == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($penerima->status_verifikasi == 'diterima')
                                                    <span class="badge badge-success">Diterima</span>
                                                @else
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $penerima->created_at->format('d/m/Y') }}</td>
                                            <td class="td-actions text-right">
                                                <a href="{{ route('penerima-bansos.show', $penerima) }}" rel="tooltip" title="View" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('penerima-bansos.edit', $penerima) }}" rel="tooltip" title="Edit" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('penerima-bansos.destroy', $penerima) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin?');">
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
                                            <td colspan="8" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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

