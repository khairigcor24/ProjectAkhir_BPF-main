{{-- Statistik Cards untuk Staff --}}
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class="icon-big text-center icon-warning">
                            <i class="nc-icon nc-badge text-warning"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">Pending</p>
                            <p class="card-title">{{ $stats['penerima_pending'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-clock-o"></i> Menunggu Verifikasi
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
                            <i class="nc-icon nc-check-2 text-success"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">Diterima</p>
                            <p class="card-title">{{ $stats['penerima_diterima'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-check-circle"></i> Sudah Diverifikasi
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
                            <i class="nc-icon nc-time-alarm text-info"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">Dijadwalkan</p>
                            <p class="card-title">{{ $stats['penyaluran_dijadwalkan'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-calendar"></i> Penyaluran Dijadwalkan
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
                            <i class="nc-icon nc-delivery-fast text-primary"></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">Diproses</p>
                            <p class="card-title">{{ $stats['penyaluran_diproses'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <hr>
                <div class="stats">
                    <i class="fa fa-spinner"></i> Sedang Diproses
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Penerima Pending (Card View) --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Penerima Bansos Menunggu Verifikasi</h4>
                <p class="card-category">Verifikasi pendaftaran penerima bansos</p>
            </div>
            <div class="card-body">
                @forelse($penerimaPending as $penerima)
                <div class="card" style="margin-bottom: 15px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="card-title">{{ $penerima->nama_lengkap }}</h5>
                                <p class="card-text">
                                    <strong>NIK:</strong> {{ $penerima->nik }}<br>
                                    <strong>Program:</strong> {{ $penerima->programBansos->nama_program }}<br>
                                    <strong>Alamat:</strong> {{ $penerima->alamat }}
                                </p>
                                <small class="text-muted">
                                    <i class="fa fa-calendar"></i> Didaftarkan: {{ $penerima->created_at->format('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class="col-md-4 text-right">
                                <span class="badge badge-warning badge-lg">Menunggu Verifikasi</span>
                                <div class="mt-3">
                                    <a href="{{ route('penerima-bansos.show', $penerima) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Tidak ada penerima bansos yang menunggu verifikasi.
                </div>
                @endforelse
            </div>
            <div class="card-footer">
                <a href="{{ route('penerima-bansos.index') }}" class="btn btn-primary">Lihat Semua Penerima</a>
            </div>
        </div>
    </div>
</div>

{{-- Penyaluran Pending (Card View) --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Penyaluran Bansos yang Perlu Diproses</h4>
                <p class="card-category">Penyaluran yang perlu ditindaklanjuti</p>
            </div>
            <div class="card-body">
                @forelse($penyaluranPending as $penyaluran)
                <div class="card" style="margin-bottom: 15px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="card-title">{{ $penyaluran->penerimaBansos->nama_lengkap }}</h5>
                                <p class="card-text">
                                    <strong>Program:</strong> {{ $penyaluran->programBansos->nama_program }}<br>
                                    <strong>Nominal:</strong> Rp {{ number_format($penyaluran->nominal_diterima, 0, ',', '.') }}<br>
                                    <strong>Metode:</strong> {{ ucfirst($penyaluran->metode_penyaluran) }}
                                </p>
                                <small class="text-muted">
                                    <i class="fa fa-calendar"></i> Tanggal: {{ $penyaluran->tanggal_penyaluran->format('d/m/Y') }}
                                </small>
                            </div>
                            <div class="col-md-4 text-right">
                                @if($penyaluran->status == 'dijadwalkan')
                                    <span class="badge badge-info badge-lg">Dijadwalkan</span>
                                @elseif($penyaluran->status == 'diproses')
                                    <span class="badge badge-warning badge-lg">Diproses</span>
                                @endif
                                <div class="mt-3">
                                    <a href="{{ route('penyaluran-bansos.show', $penyaluran) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Tidak ada penyaluran yang perlu diproses.
                </div>
                @endforelse
            </div>
            <div class="card-footer">
                <a href="{{ route('penyaluran-bansos.index') }}" class="btn btn-primary">Lihat Semua Penyaluran</a>
            </div>
        </div>
    </div>
</div>
