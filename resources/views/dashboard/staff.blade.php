@extends('layouts.public', ['activePage' => 'welcome', 'title' => 'SEJAHTERA'])

@section('content')
    <div class="dashboard-wrapper">
        <style>
            .full-page {
                position: relative;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                background: rgba(0, 0, 0, 0.3);
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
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
                margin-bottom: 1rem;
            }

            .welcome-subtitle {
                font-size: 1.5rem;
                color: #fff;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
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
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }

            .welcome-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
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

            .dashboard-wrapper {
                background: linear-gradient(180deg, #f4f7fb 0%, #eef2f7 100%);
                min-height: 100vh;
                padding: 30px 0;
                position: relative;
            }

            .dashboard-wrapper::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="%23e0e6ed" opacity="0.1"/></svg>') repeat;
                z-index: 0;
            }

            .container-dashboard {
                padding-left: 2rem;
                padding-right: 2rem;
                position: relative;
                z-index: 1;
            }

            .stat-card {
                transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                border-left: 5px solid transparent;
                background: white;
                border-radius: 15px;
                overflow: hidden;
                position: relative;
            }

            .stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
                opacity: 0;
                transition: opacity 0.3s;
            }

            .stat-card:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
                border-radius: 20px;
            }

            .stat-card:hover::before {
                opacity: 1;
            }

            .stat-card.border-warning {
                border-color: #ffc107;
            }

            .stat-card.border-success {
                border-color: #28a745;
            }

            .stat-card.border-info {
                border-color: #17a2b8;
            }

            .stat-card.border-primary {
                border-color: #007bff;
            }

            .stat-hover {
                transition: all 0.35s ease;
                background: white;
            }

            .stat-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            }

            .icon-big i {
                font-size: 36px;
                transition: transform 0.3s;
            }

            .stat-card:hover .icon-big i {
                transform: scale(1.2) rotate(5deg);
            }

            .counter {
                font-size: 2rem;
                font-weight: bold;
                color: #333;
                transition: color 0.3s;
            }

            .stat-card:hover .counter {
                color: #007bff;
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

            /* New animations */
            .fade-in {
                animation: fadeIn 0.8s ease-out;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .slide-up {
                animation: slideUp 0.8s ease-out;
            }

            @keyframes slideUp {
                from { transform: translateY(50px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            .bounce-in {
                animation: bounceIn 1s ease-out;
            }

            @keyframes bounceIn {
                0% { transform: scale(0.3); opacity: 0; }
                50% { transform: scale(1.05); }
                70% { transform: scale(0.9); }
                100% { transform: scale(1); opacity: 1; }
            }

            /* Chart enhancements */
            .card {
                border-radius: 15px;
                border: none;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            .card-header {
                border-radius: 15px 15px 0 0 !important;
                border: none;
            }

            /* Table enhancements */
            .table {
                border-radius: 10px;
                overflow: hidden;
            }

            .table thead th {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                font-weight: 600;
            }

            .table tbody tr {
                transition: background 0.3s, transform 0.3s;
            }

            .table tbody tr:hover {
                background: rgba(102, 126, 234, 0.1);
                transform: scale(1.01);
            }

            .badge {
                transition: transform 0.2s;
            }

            .badge:hover {
                transform: scale(1.1);
            }

            .btn {
                border-radius: 25px;
                transition: all 0.3s;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            /* Progress bar animation */
            .progress-bar {
                transition: width 1s ease-in-out;
            }

            /* Additional styles for enhanced sections */
            .bg-gradient-primary {
                background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            }

            .bg-gradient-warning {
                background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            }

            .stat-mini {
                padding: 15px;
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                transition: all 0.3s;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .stat-mini:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                background: rgba(255, 255, 255, 0.9);
            }

            .progress-text {
                font-weight: bold;
                color: white;
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            }

            .badge-pill {
                border-radius: 50px;
            }
        </style>

        <div class="container-fluid container-dashboard">
            <div class="row fade-in">
                @php
                    $cards = [
                        [
                            'title' => 'Pending',
                            'value' => $stats['penerima_pending'],
                            'icon' => 'nc-badge',
                            'color' => 'warning',
                            'desc' => 'Menunggu Verifikasi',
                        ],
                        [
                            'title' => 'Diterima',
                            'value' => $stats['penerima_diterima'],
                            'icon' => 'nc-check-2',
                            'color' => 'success',
                            'desc' => 'Sudah Diverifikasi',
                        ],
                        [
                            'title' => 'Dijadwalkan',
                            'value' => $stats['penyaluran_dijadwalkan'],
                            'icon' => 'nc-time-alarm',
                            'color' => 'info',
                            'desc' => 'Penyaluran Dijadwalkan',
                        ],
                        [
                            'title' => 'Diproses',
                            'value' => $stats['penyaluran_diproses'],
                            'icon' => 'nc-delivery-fast',
                            'color' => 'primary',
                            'desc' => 'Sedang Diproses',
                        ],
                    ];
                @endphp

                @foreach ($cards as $index => $card)
                    <div class="mb-4 col-lg-3 col-md-6 slide-up" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="card stat-card stat-hover border-start border-4 border-{{ $card['color'] }}">
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
        </div>

        {{-- ================= CHART RINGKASAN DATA PENERIMA ================= --}}
        <div class="row mb-5 bounce-in">
            <div class="col-md-8">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa fa-chart-pie mr-2"></i>Ringkasan Data Penerima</h5>
                    </div>
                    <div class="card-body">
                        <div style="position: relative; height:320px;">
                            <canvas id="chartStatus"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="text-muted mb-2"><i class="fa fa-users mr-2"></i>Total Penerima</h6>
                        <h2 class="font-weight-bold mb-4 counter" data-count="{{ array_sum($stats) }}">0</h2>

                        <p class="mb-1 text-warning"><i class="fa fa-clock mr-2"></i>Pending</p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-warning"
                                style="width: {{ ($stats['penerima_pending'] / max(array_sum($stats), 1)) * 100 }}%">
                            </div>
                        </div>

                        <p class="mb-1 text-success"><i class="fa fa-check mr-2"></i>Diterima</p>
                        <div class="progress">
                            <div class="progress-bar bg-success"
                                style="width: {{ ($stats['penerima_diterima'] / max(array_sum($stats), 1)) * 100 }}%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const totalPenerima = {{ array_sum($stats) }};

            new Chart(document.getElementById('chartStatus'), {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Diterima', 'Dijadwalkan', 'Diproses'],
                    datasets: [{
                        data: [
                            {{ $stats['penerima_pending'] }},
                            {{ $stats['penerima_diterima'] }},
                            {{ $stats['penyaluran_dijadwalkan'] }},
                            {{ $stats['penyaluran_diproses'] }}
                        ],
                        backgroundColor: ['#ffc107', '#28a745', '#17a2b8', '#007bff'],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true
                            }
                        }
                    }
                },
                plugins: [{
                    id: 'centerText',
                    beforeDraw(chart) {
                        const {
                            ctx
                        } = chart;
                        ctx.save();
                        ctx.font = 'bold 26px sans-serif';
                        ctx.fillStyle = '#333';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(totalPenerima, chart.width / 2, chart.height / 2 - 5);
                        ctx.font = '14px sans-serif';
                        ctx.fillText('Total', chart.width / 2, chart.height / 2 + 18);
                    }
                }]
            });
        </script>


        {{-- Animasi Countdown Data di tampilan Kartu Penerima Bansos --}}
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Counter animation
                document.querySelectorAll('.counter').forEach(counter => {
                    const updateCount = () => {
                        const target = +counter.getAttribute('data-count');
                        const count = +counter.innerText;
                        const speed = 100;
                        const increment = target / speed;
                        if (count < target) {
                            counter.innerText = Math.ceil(count + increment);
                            setTimeout(updateCount, 10);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                });

                // Search functionality
                const searchInput = document.getElementById('searchInput');
                const table = document.getElementById('pendingTable');
                const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                searchInput.addEventListener('keyup', function() {
                    const filter = searchInput.value.toLowerCase();
                    for (let i = 0; i < rows.length; i++) {
                        const cells = rows[i].getElementsByTagName('td');
                        let found = false;
                        for (let j = 0; j < cells.length; j++) {
                            if (cells[j].textContent.toLowerCase().indexOf(filter) > -1) {
                                found = true;
                                break;
                            }
                        }
                        rows[i].style.display = found ? '' : 'none';
                    }
                });

                // Add tooltip functionality
                const statCards = document.querySelectorAll('.stat-card');
                statCards.forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-10px) scale(1.02)';
                    });
                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0) scale(1)';
                    });
                });

                // Progress bar animation on scroll
                const progressBars = document.querySelectorAll('.progress-bar');
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.width = entry.target.style.width;
                        }
                    });
                });
                progressBars.forEach(bar => observer.observe(bar));
            });
        </script>

        {{-- ================= PENERIMA PENDING ================= --}}
        <div class="row slide-up">
            <div class="col-md-12">
                <div class="shadow-sm card">
                    <div class="card-header bg-gradient-warning text-white">
                        <h4 class="card-title"><i class="fa fa-clock mr-2"></i>Penerima Menunggu Verifikasi</h4>
                        <p class="card-category">Validasi pendaftaran bansos</p>

                        <div class="px-3 mb-3">
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari penerima...">
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($penerimaPending->isEmpty())
                            <div class="text-center py-5 text-muted">
                                <i class="fa fa-inbox fa-3x mb-3"></i>
                                <p class="mb-0">Belum ada penerima yang menunggu verifikasi</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table align-middle table-hover" id="pendingTable">
                                    <thead>
                                        <tr>
                                            <th><i class="fa fa-user mr-2"></i>Nama</th>
                                            <th><i class="fa fa-list mr-2"></i>Program</th>
                                            <th><i class="fa fa-id-card mr-2"></i>NIK</th>
                                            <th><i class="fa fa-calendar mr-2"></i>Tanggal Daftar</th>
                                            <th><i class="fa fa-info-circle mr-2"></i>Status</th>
                                            <th><i class="fa fa-cogs mr-2"></i>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penerimaPending as $penerima)
                                            <tr>
                                                <td>{{ $penerima->nama_lengkap }}</td>
                                                <td>{{ $penerima->programBansos->nama_program }}</td>
                                                <td>{{ $penerima->nik }}</td>
                                                <td>{{ $penerima->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <span class="badge rounded-pill bg-warning px-3 py-2">
                                                        <i class="fa fa-clock mr-1"></i>Menunggu</span></td>
                                                <td>
                                                    <a href="{{ route('penerima-bansos.show', $penerima) }}"
                                                        class="btn btn-sm btn-outline-info">
                                                        <i class="fa fa-eye"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('penerima-bansos.index') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-list mr-2"></i>Lihat Semua
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= PENYALURAN ================= --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Status Penyaluran Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Penyaluran Januari 2026</strong></p>
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                                style="width: 70%">
                                70% Tersalurkan
                            </div>
                        </div>

                        <small class="text-muted">Diperbarui: {{ now()->format('d M Y H:i') }}</small>
                    </div>
                </div>
            </div>
