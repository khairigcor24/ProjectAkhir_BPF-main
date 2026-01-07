{{-- ================= STATISTIK DASHBOARD ================= --}}
<style>
    /* === UI POLISH === */
    .stat-card, .hover-card {
        transition: all .25s ease;
    }
    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,.08);
    }
    .hover-card:hover {
        background: #f8f9fa;
    }
    .icon-big i {
        font-size: 2.5rem;
    }
    </style>

    <div class="row">
    @php
    $cards = [
        ['title'=>'Pending','value'=>$stats['penerima_pending'],'icon'=>'nc-badge','color'=>'warning','desc'=>'Menunggu Verifikasi'],
        ['title'=>'Diterima','value'=>$stats['penerima_diterima'],'icon'=>'nc-check-2','color'=>'success','desc'=>'Sudah Diverifikasi'],
        ['title'=>'Dijadwalkan','value'=>$stats['penyaluran_dijadwalkan'],'icon'=>'nc-time-alarm','color'=>'info','desc'=>'Penyaluran Dijadwalkan'],
        ['title'=>'Diproses','value'=>$stats['penyaluran_diproses'],'icon'=>'nc-delivery-fast','color'=>'primary','desc'=>'Sedang Diproses'],
    ];
    @endphp

    @foreach($cards as $card)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="icon-big text-{{ $card['color'] }} mr-3">
                    <i class="nc-icon {{ $card['icon'] }}"></i>
                </div>
                <div>
                    <p class="mb-1 text-muted small">{{ $card['title'] }}</p>
                    <h4 class="font-weight-bold counter" data-count="{{ $card['value'] }}">0</h4>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0">
                <small class="text-muted">{{ $card['desc'] }}</small>
            </div>
        </div>
    </div>
    @endforeach
    </div>

    {{-- ================= PENERIMA PENDING ================= --}}
    <div class="row">
    <div class="col-md-12">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="card-title">Penerima Menunggu Verifikasi</h4>
            <p class="card-category">Validasi pendaftaran bansos</p>
        </div>

        <div class="card-body">
            @forelse($penerimaPending as $penerima)
            <div class="card mb-3 hover-card shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 font-weight-bold">{{ $penerima->nama_lengkap }}</h6>
                        <small class="text-muted">
                            {{ $penerima->programBansos->nama_program }} • {{ $penerima->nik }}
                        </small>
                        <br>
                        <small class="text-muted">
                            <i class="fa fa-calendar"></i>
                            {{ $penerima->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                    <div class="text-right">
                        <span class="badge badge-warning mb-2">Menunggu</span><br>
                        <a href="{{ route('penerima-bansos.show', $penerima) }}" class="btn btn-sm btn-outline-info">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Tidak ada penerima pending.
            </div>
            @endforelse
        </div>

        <div class="card-footer">
            <a href="{{ route('penerima-bansos.index') }}" class="btn btn-primary btn-sm">
                Lihat Semua
            </a>
        </div>
    </div>
    </div>
    </div>

    {{-- ================= PENYALURAN ================= --}}
    <div class="row">
    <div class="col-md-12">
    <div
