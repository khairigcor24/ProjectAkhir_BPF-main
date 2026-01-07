{{-- Statistik Cards --}}
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-paper-2 text-warning"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">Program Bansos</p>
                            <p class="card-title">{{ $stats['total_program'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-check-circle"></i> {{ $stats['program_aktif'] }} Aktif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-badge text-info"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">Total Penerima</p>
                            <p class="card-title">{{ $stats['total_penerima'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> {{ $stats['penerima_pending'] }} Menunggu Verifikasi
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-delivery-fast text-success"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">Penyaluran</p>
                            <p class="card-title">{{ $stats['total_penyaluran'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-check-circle"></i> {{ $stats['penyaluran_disalurkan'] }} Disalurkan
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-money-coins text-danger"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">Total Donasi</p>
                            <p class="card-title">Rp {{ number_format($stats['total_nominal_donasi'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-calendar-o"></i> {{ $stats['total_donasi'] }} Total Donasi
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Program Terbaru --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Program Bansos Terbaru</h4>
                <p class="card-category">Program yang baru ditambahkan</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <th>Nama Program</th>
                            <th>Kuota</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-right">Actions</th>
                        </thead>
                        <tbody>
                            @forelse($programTerbaru as $program)
                            <tr>
                                <td>{{ $program->nama_program }}</td>
                                <td>{{ $program->kuota }}</td>
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
                                <td class="text-right">
                                    <a href="{{ route('program-bansos.show', $program) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada program bansos</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('program-bansos.index') }}" class="btn btn-primary">Lihat Semua Program</a>
            </div>
        </div>
    </div>
</div>

{{-- Penerima Terbaru --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Penerima Bansos Terbaru</h4>
                <p class="card-category">Pendaftaran terbaru yang perlu diverifikasi</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th class="text-right">Actions</th>
                        </thead>
                        <tbody>
                            @forelse($penerimaTerbaru as $penerima)
                            <tr>
                                <td>{{ $penerima->nama_lengkap }}</td>
                                <td>{{ $penerima->nik }}</td>
                                <td>{{ $penerima->programBansos->nama_program }}</td>
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
                                <td class="text-right">
                                    <a href="{{ route('penerima-bansos.show', $penerima) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada penerima bansos</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('penerima-bansos.index') }}" class="btn btn-primary">Lihat Semua Penerima</a>
            </div>
        </div>
    </div>
</div>
