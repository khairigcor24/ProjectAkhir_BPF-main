@extends('layouts.public', ['activePage' => 'welcome', 'title' => 'SEJAHTERA'])

@section('content')
    <style>
        .content {
            padding-top: 90px;
            background:
                linear-gradient(135deg,
                    rgba(102, 126, 234, 0.08) 0%,
                    rgba(118, 75, 162, 0.1) 100%),
                );
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: calc(100vh - 90px);
            position: relative;
        }

        .content::before {
            z-index: 0;
        }

        .card-stats {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: none;
            border-radius: 15px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
            overflow: hidden;
            position: relative;
        }

        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card-stats::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        }

        .icon-big {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        .card-stats:hover .icon-big {
            transform: scale(1.1);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .card-stats .numbers p {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .card-stats .numbers h4 {
            font-weight: 700;
            color: #495057;
            margin: 0;
        }

        .card-footer {
            background: rgba(248, 249, 250, 0.8);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-footer .stats {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .strpied-tabled-with-hover {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .card-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: rgba(102, 126, 234, 0.1);
            border-bottom: 2px solid #667eea;
            color: #495057;
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.06);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 10px;
            letter-spacing: 0.3px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .btn-info:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #138496 0%, #117a8b 100%);
        }

        .btn-link.btn-xs {
            font-weight: 600;
            color: #667eea;
        }

        .btn-link.btn-xs:hover {
            text-decoration: none;
            color: #5a67d8;
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

        @media (max-width: 768px) {
            .card-stats {
                margin-bottom: 1rem 1.;
            }

            .card-header {
                padding: 1rem 1.25rem;
            }

            .card-header h4 {
                font-size: 1.1rem;
            }

            .card-header p {
                font-size: 0.85rem;
            }

            .table thead th,
            .table tbody td {
                padding: 0.5rem;
                font-size: 0.9rem;
            }
        }
    </style>

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
                                        <h4 class="card-title" style="font-size: 16px;"><b>Rp
                                                {{ number_format($stats['total_nominal_donasi'], 0, ',', '.') }}</b></h4>
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
                <div class="col-md-12 mt-5">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="card-title">Program Bansos Terbaru</h4>
                                    <p class="card-category">Data program yang baru saja ditambahkan</p>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('program-bansos.index') }}"
                                        class="btn btn-primary btn-fill btn-sm">Lihat Semua</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th class="pl-4">Nama Program</th>
                                    <th class="text-center">Kuota</th>
                                    <th class="text-right">Nominal</th>
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
                                                <span
                                                    class="badge {{ $program->status == 'aktif' ? 'badge-success' : 'badge-secondary' }}">
                                                    {{ ucfirst($program->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $program->tanggal_mulai->format('d/m/Y') }}</td>
                                            <td class="td-actions text-right pr-4">
                                                <a href="{{ route('program-bansos.show', $program) }}"
                                                    class="btn btn-info btn-link btn-xs">
                                                    <i class="fa fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                Belum ada program untuk ditampilkan</td>
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
                                    <a href="{{ route('penerima-bansos.index') }}"
                                        class="btn btn-primary btn-fill btn-sm">Lihat Semua</a>
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
                                                @if ($penerima->status_verifikasi == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($penerima->status_verifikasi == 'diterima')
                                                    <span class="badge badge-success">Diterima</span>
                                                @else
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $penerima->created_at->format('d/m/Y') }}</td>
                                            <td class="td-actions text-right pr-4">
                                                <a href="{{ route('penerima-bansos.show', $penerima) }}"
                                                    class="btn btn-info btn-link btn-xs">
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
