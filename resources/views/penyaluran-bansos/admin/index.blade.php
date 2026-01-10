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
                                <p class="text-sm mb-0">Tracking penyaluran bantuan sosial</p>
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

                        {{-- Search dan Filter --}}
                        <form method="GET" action="{{ route('penyaluran-bansos.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari nama/NIK..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="">Semua Status</option>
                                            <option value="dijadwalkan" {{ request('status') == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="disalurkan" {{ request('status') == 'disalurkan' ? 'selected' : '' }}>Disalurkan</option>
                                            <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="metode_penyaluran" class="form-control">
                                            <option value="">Semua Metode</option>
                                            <option value="transfer" {{ request('metode_penyaluran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                            <option value="tunai" {{ request('metode_penyaluran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                            <option value="voucher" {{ request('metode_penyaluran') == 'voucher' ? 'selected' : '' }}>Voucher</option>
                                            <option value="barang" {{ request('metode_penyaluran') == 'barang' ? 'selected' : '' }}>Barang</option>
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
                                        <th>Penerima</th>
                                        <th>Program</th>
                                        <th>Nominal</th>
                                        <th>Metode</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($penyaluranBansos as $index => $penyaluran)
                                        <tr>
                                            <td>{{ $penyaluranBansos->firstItem() + $index }}</td>
                                            <td>
                                                <strong>{{ $penyaluran->penerimaBansos->nama_lengkap }}</strong><br>
                                                <small class="text-muted">{{ $penyaluran->penerimaBansos->nik }}</small>
                                            </td>
                                            <td>{{ $penyaluran->programBansos->nama_program }}</td>
                                            <td>Rp {{ number_format($penyaluran->nominal_diterima, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge badge-info">{{ ucfirst($penyaluran->metode_penyaluran) }}</span>
                                            </td>
                                            <td>
                                                @if($penyaluran->status == 'dijadwalkan')
                                                    <span class="badge badge-secondary">Dijadwalkan</span>
                                                @elseif($penyaluran->status == 'diproses')
                                                    <span class="badge badge-warning">Diproses</span>
                                                @elseif($penyaluran->status == 'disalurkan')
                                                    <span class="badge badge-success">Disalurkan</span>
                                                @else
                                                    <span class="badge badge-danger">Gagal</span>
                                                @endif
                                            </td>
                                            <td>{{ $penyaluran->tanggal_penyaluran->format('d/m/Y') }}</td>
                                            <td class="td-actions text-right">
                                                <a href="{{ route('penyaluran-bansos.show', $penyaluran) }}" rel="tooltip" title="View" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('penyaluran-bansos.edit', $penyaluran) }}" rel="tooltip" title="Edit" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @if(auth()->user()->isAdmin())
                                                <form action="{{ route('penyaluran-bansos.destroy', $penyaluran) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" rel="tooltip" title="Delete" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                                @endif
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





