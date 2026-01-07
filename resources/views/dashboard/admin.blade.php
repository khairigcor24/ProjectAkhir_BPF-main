<div class="content">
    <div class="container-fluid">
        {{-- Statistik Cards --}}
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-paper-2 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Program Bansos</p>
                                    <h4 class="card-title"><b>{{ $stats['total_program'] }}</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats text-success">
                            <i class="fa fa-check-circle"></i> {{ $stats['program_aktif'] }} Aktif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-badge text-info"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Total Penerima</p>
                                    <h4 class="card-title"><b>{{ $stats['total_penerima'] }}</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats text-warning">
                            <i class="fa fa-clock-o"></i> {{ $stats['penerima_pending'] }} Pending
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-delivery-fast text-success"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Penyaluran</p>
                                    <h4 class="card-title"><b>{{ $stats['total_penyaluran'] }}</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-refresh"></i> {{ $stats['penyaluran_disalurkan'] }} Selesai
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-money-coins text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Total Donasi</p>
                                    <h4 class="card-title" style="font-size: 16px;"><b>Rp {{ number_format($stats['total_nominal_donasi'], 0, ',', '.') }}</b></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-heart text-danger"></i> {{ $stats['total_donasi'] }} Donatur
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row untuk Tabel --}}
        <div class="row">
            {{-- Program Terbaru --}}
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Program Bansos Terbaru</h4>
                                <p class="card-category">Data program yang baru saja ditambahkan</p>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('program-bansos.index') }}" class="btn btn-primary btn-fill btn-sm">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th class="pl-4">Nama Program</th>
                                <th>Kuota</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th class="text-right pr-4">Aksi</th>
                            </thead>
                            <tbody>
                                @forelse($programTerbaru as $program)
                                <tr>
                                    <td class="pl-4">{{ $program->nama_program }}</td>
                                    <td>{{ $program->kuota }}</td>
                                    <td>Rp {{ number_format($program->nominal_bantuan ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $program->status == 'aktif' ? 'badge-success' : 'badge-secondary' }}">
                                            {{ ucfirst($program->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $program->tanggal_mulai->format('d/m/Y') }}</td>
                                    <td class="td-actions text-right pr-4">
                                        <a href="{{ route('program-bansos.show', $program) }}" class="btn btn-info btn-link btn-xs">
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
            </div>

            {{-- Penerima Terbaru --}}
            <div class="col-md-12 mt-4">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <h4 class="card-title">Penerima Bansos Terbaru</h4>
                                <p class="card-category">Pendaftaran yang membutuhkan verifikasi</p>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('penerima-bansos.index') }}" class="btn btn-primary btn-fill btn-sm">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th class="pl-4">Nama</th>
                                <th>NIK</th>
                                <th>Program</th>
                                <th>Status</th>
                                <th>Tanggal Daftar</th>
                                <th class="text-right pr-4">Aksi</th>
                            </thead>
                            <tbody>
                                @forelse($penerimaTerbaru as $penerima)
                                <tr>
                                    <td class="pl-4">{{ $penerima->nama_lengkap }}</td>
                                    <td><code>{{ $penerima->nik }}</code></td>
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
                                    <td class="td-actions text-right pr-4">
                                        <a href="{{ route('penerima-bansos.show', $penerima) }}" class="btn btn-info btn-link btn-xs">
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
            </div>
        </div>
    </div>
</div>
