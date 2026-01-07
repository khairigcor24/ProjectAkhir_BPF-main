@extends('layouts.app', ['activePage' => 'penerima-bansos', 'title' => 'Detail Penerima Bansos', 'navName' => 'Detail Penerima', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="card-title">{{ $penerimaBansos->nama_lengkap }}</h4>
                                <p class="card-category">Detail Data Penerima Bansos</p>
                            </div>
                            <div class="col-4 text-right">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('penerima-bansos.edit', $penerimaBansos) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3">Informasi Program</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">Program Bansos</th>
                                        <td>{{ $penerimaBansos->programBansos->nama_program }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Verifikasi</th>
                                        <td>
                                            @if($penerimaBansos->status_verifikasi == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($penerimaBansos->status_verifikasi == 'diterima')
                                                <span class="badge badge-success">Diterima</span>
                                            @else
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if($penerimaBansos->catatan_verifikasi)
                                    <tr>
                                        <th>Catatan Verifikasi</th>
                                        <td>{{ $penerimaBansos->catatan_verifikasi }}</td>
                                    </tr>
                                    @endif
                                    @if($penerimaBansos->verifier)
                                    <tr>
                                        <th>Diverifikasi Oleh</th>
                                        <td>{{ $penerimaBansos->verifier->name }}</td>
                                    </tr>
                                    @endif
                                    @if($penerimaBansos->tanggal_verifikasi)
                                    <tr>
                                        <th>Tanggal Verifikasi</th>
                                        <td>{{ $penerimaBansos->tanggal_verifikasi->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-3">Data Pribadi</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">NIK</th>
                                        <td>{{ $penerimaBansos->nik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>{{ $penerimaBansos->nama_lengkap }}</td>
                                    </tr>
                                    @if($penerimaBansos->tempat_lahir || $penerimaBansos->tanggal_lahir)
                                    <tr>
                                        <th>Tempat/Tanggal Lahir</th>
                                        <td>{{ $penerimaBansos->tempat_lahir ?? '-' }} / {{ $penerimaBansos->tanggal_lahir ? $penerimaBansos->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                    @endif
                                    @if($penerimaBansos->jenis_kelamin)
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $penerimaBansos->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $penerimaBansos->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>RT/RW</th>
                                        <td>{{ $penerimaBansos->rt ?? '-' }} / {{ $penerimaBansos->rw ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kelurahan/Kecamatan</th>
                                        <td>{{ $penerimaBansos->kelurahan ?? '-' }} / {{ $penerimaBansos->kecamatan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kota/Kabupaten</th>
                                        <td>{{ $penerimaBansos->kota_kabupaten ?? '-' }}</td>
                                    </tr>
                                    @if($penerimaBansos->provinsi)
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>{{ $penerimaBansos->provinsi }}</td>
                                    </tr>
                                    @endif
                                    @if($penerimaBansos->telepon)
                                    <tr>
                                        <th>Telepon</th>
                                        <td>{{ $penerimaBansos->telepon }}</td>
                                    </tr>
                                    @endif
                                    @if($penerimaBansos->email)
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $penerimaBansos->email }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h5 class="mb-3">Informasi Ekonomi</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">Jumlah Anggota Keluarga</th>
                                        <td>{{ $penerimaBansos->jumlah_anggota_keluarga }}</td>
                                    </tr>
                                    @if($penerimaBansos->penghasilan_perbulan)
                                    <tr>
                                        <th>Penghasilan per Bulan</th>
                                        <td>Rp {{ number_format($penerimaBansos->penghasilan_perbulan, 0, ',', '.') }}</td>
                                    </tr>
                                    @endif
                                    @if($penerimaBansos->status_ekonomi)
                                    <tr>
                                        <th>Status Ekonomi</th>
                                        <td>{{ ucwords(str_replace('_', ' ', $penerimaBansos->status_ekonomi)) }}</td>
                                    </tr>
                                    @endif
                                    @if($penerimaBansos->keterangan)
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>{{ $penerimaBansos->keterangan }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        @if($penerimaBansos->dokumen_pendukung && count($penerimaBansos->dokumen_pendukung) > 0)
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h5 class="mb-3">Dokumen Pendukung</h5>
                                <div class="row">
                                    @foreach($penerimaBansos->dokumen_pendukung as $dokumen)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <i class="fa fa-file-pdf fa-3x text-danger mb-2"></i>
                                                    <p class="small">{{ basename($dokumen) }}</p>
                                                    <a href="{{ asset('storage/' . $dokumen) }}" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(auth()->user()->isAdminOrStaff() && $penerimaBansos->status_verifikasi == 'pending')
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h5>Verifikasi Penerima</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('penerima-bansos.verify', $penerimaBansos) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Status Verifikasi <span class="text-danger">*</span></label>
                                                        <select name="status_verifikasi" class="form-control" required>
                                                            <option value="diterima">Diterima</option>
                                                            <option value="ditolak">Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Catatan</label>
                                                        <textarea name="catatan_verifikasi" class="form-control" rows="2" placeholder="Catatan verifikasi (opsional)">{{ old('catatan_verifikasi', $penerimaBansos->catatan_verifikasi) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check"></i> Simpan Verifikasi
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="card-footer">
                            <a href="{{ route('penerima-bansos.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



