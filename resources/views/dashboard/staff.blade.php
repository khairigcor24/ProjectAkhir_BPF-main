@extends('layouts.public', ['activePage' => 'welcome', 'title' => 'SEJAHTERA'])

@section('content')
<style>
    .full-page {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        overflow: hidden;
    }

    .full-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 2rem;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .welcome-title {
        font-size: 4rem;
        font-weight: bold;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        margin-bottom: 1rem;
    }

    .welcome-subtitle {
        font-size: 1.5rem;
        color: #fff;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .welcome-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 15px 40px;
        font-size: 1.1rem;
        color: white;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .welcome-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        color: white;
    }

    .welcome-btn-secondary {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 2px solid white;
    }

    .welcome-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
    }

    .image-counter {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        z-index: 3;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .welcome-title {
            font-size: 2.5rem;
        }
        .welcome-subtitle {
            font-size: 1.2rem;
        }
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
    <div class="mb-4 col-lg-3 col-md-6">
        <div class="shadow-sm card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-big text-{{ $card['color'] }} mr-3">
                    <i class="nc-icon {{ $card['icon'] }}"></i>
                </div>
                <div>
                    <p class="mb-1 text-muted small">{{ $card['title'] }}</p>
                    <h4 class="font-weight-bold counter" data-count="{{ $card['value'] }}">0</h4>
                </div>
            </div>
            <div class="pt-0 bg-transparent border-0 card-footer">
                <small class="text-muted">{{ $card['desc'] }}</small>
            </div>
        </div>
    </div>
    @endforeach
    </div>

    {{-- ================= PENERIMA PENDING ================= --}}
    <div class="row">
    <div class="col-md-12">
    <div class="shadow-sm card">
        <div class="card-header">
            <h4 class="card-title">Penerima Menunggu Verifikasi</h4>
            <p class="card-category">Validasi pendaftaran bansos</p>
        </div>

        <div class="card-body">
            @forelse($penerimaPending as $penerima)
            <div class="mb-3 shadow-sm card hover-card">
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
                        <span class="mb-2 badge badge-warning">Menunggu</span><br>
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
