@extends('layouts.app', ['activePage' => 'penyaluran-bansos', 'title' => 'Detail Penyaluran Bansos', 'navName' => 'Detail Penyaluran', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="card-title">Detail Penyaluran Bansos</h4>
                                <p class="card-category">Informasi lengkap penyaluran</p>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('penyaluran-bansos.edit', $penyaluranBansos) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Informasi Penerima</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">Nama</th>
                                        <td>{{ $penyaluranBansos->penerimaBansos->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>{{ $penyaluranBansos->penerimaBansos->nik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $penyaluranBansos->penerimaBansos->alamat }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">Informasi Penyaluran</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">Program Bansos</th>
                                        <td>{{ $penyaluranBansos->programBansos->nama_program }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nominal Diterima</th>
                                        <td><strong>Rp {{ number_format($penyaluranBansos->nominal_diterima, 0, ',', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Metode Penyaluran</th>
                                        <td>
                                            <span class="badge badge-info">{{ ucfirst($penyaluranBansos->metode_penyaluran) }}</span>
                                        </td>
                                    </tr>
                                    @if($penyaluranBansos->metode_penyaluran == 'transfer')
                                    <tr>
                                        <th>No Rekening</th>
                                        <td>{{ $penyaluranBansos->no_rekening ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Bank</th>
                                        <td>{{ $penyaluranBansos->nama_bank ?? '-' }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Tanggal Penyaluran</th>
                                        <td>{{ $penyaluranBansos->tanggal_penyaluran->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($penyaluranBansos->status == 'dijadwalkan')
                                                <span class="badge badge-secondary">Dijadwalkan</span>
                                            @elseif($penyaluranBansos->status == 'diproses')
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif($penyaluranBansos->status == 'disalurkan')
                                                <span class="badge badge-success">Disalurkan</span>
                                            @else
                                                <span class="badge badge-danger">Gagal</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($penyaluranBansos->catatan)
                                    <tr>
                                        <th>Catatan</th>
                                        <td>{{ $penyaluranBansos->catatan }}</td>
                                    </tr>
                                    @endif
                                    @if($penyaluranBansos->distributor)
                                    <tr>
                                        <th>Disalurkan Oleh</th>
                                        <td>{{ $penyaluranBansos->distributor->name }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        @if($penyaluranBansos->bukti_penyaluran)
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h5 class="mb-3">Bukti Penyaluran</h5>
                                <div class="text-center">
                                    <a href="{{ asset('storage/' . $penyaluranBansos->bukti_penyaluran) }}" target="_blank" class="btn btn-primary">
                                        <i class="fa fa-download"></i> Download Bukti Penyaluran
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="card-footer">
                            <a href="{{ route('penyaluran-bansos.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





