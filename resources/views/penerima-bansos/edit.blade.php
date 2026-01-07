@extends('layouts.app', ['activePage' => 'penerima-bansos', 'title' => 'Edit Penerima Bansos', 'navName' => 'Edit Penerima', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Penerima Bansos</h4>
                        <p class="card-category">Edit data: {{ $penerimaBansos->nama_lengkap }}</p>
                    </div>
                    <div class="card-body">
                        @include('alerts.errors')

                        <form method="POST" action="{{ route('penerima-bansos.update', $penerimaBansos) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <h5 class="mb-3">Informasi Program</h5>
                            <div class="form-group{{ $errors->has('program_bansos_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Program Bansos <span class="text-danger">*</span></label>
                                <select name="program_bansos_id" class="form-control{{ $errors->has('program_bansos_id') ? ' is-invalid' : '' }}" required>
                                    @foreach($programBansos as $program)
                                        <option value="{{ $program->id }}" {{ old('program_bansos_id', $penerimaBansos->program_bansos_id) == $program->id ? 'selected' : '' }}>
                                            {{ $program->nama_program }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'program_bansos_id'])
                            </div>

                            <hr>
                            <h5 class="mb-3">Data Pribadi</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nik') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">NIK <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}" value="{{ old('nik', $penerimaBansos->nik) }}" maxlength="16" required>
                                        @include('alerts.feedback', ['field' => 'nik'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama_lengkap') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" class="form-control{{ $errors->has('nama_lengkap') ? ' is-invalid' : '' }}" value="{{ old('nama_lengkap', $penerimaBansos->nama_lengkap) }}" required>
                                        @include('alerts.feedback', ['field' => 'nama_lengkap'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $penerimaBansos->tempat_lahir) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $penerimaBansos->tanggal_lahir ? $penerimaBansos->tanggal_lahir->format('Y-m-d') : '') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('jenis_kelamin', $penerimaBansos->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $penerimaBansos->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="mb-3">Alamat</h5>
                            <div class="form-group">
                                <label class="form-control-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $penerimaBansos->alamat) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">RT</label>
                                        <input type="text" name="rt" class="form-control" value="{{ old('rt', $penerimaBansos->rt) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">RW</label>
                                        <input type="text" name="rw" class="form-control" value="{{ old('rw', $penerimaBansos->rw) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Kelurahan</label>
                                        <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan', $penerimaBansos->kelurahan) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Kecamatan</label>
                                        <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $penerimaBansos->kecamatan) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Kota/Kabupaten</label>
                                        <input type="text" name="kota_kabupaten" class="form-control" value="{{ old('kota_kabupaten', $penerimaBansos->kota_kabupaten) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Provinsi</label>
                                        <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $penerimaBansos->provinsi) }}">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="mb-3">Kontak & Informasi Ekonomi</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Telepon</label>
                                        <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $penerimaBansos->telepon) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $penerimaBansos->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Jumlah Anggota Keluarga</label>
                                        <input type="number" name="jumlah_anggota_keluarga" class="form-control" value="{{ old('jumlah_anggota_keluarga', $penerimaBansos->jumlah_anggota_keluarga) }}" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Penghasilan per Bulan (Rp)</label>
                                        <input type="number" name="penghasilan_perbulan" class="form-control" value="{{ old('penghasilan_perbulan', $penerimaBansos->penghasilan_perbulan) }}" min="0" step="0.01">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Status Ekonomi</label>
                                <select name="status_ekonomi" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="sangat_miskin" {{ old('status_ekonomi', $penerimaBansos->status_ekonomi) == 'sangat_miskin' ? 'selected' : '' }}>Sangat Miskin</option>
                                    <option value="miskin" {{ old('status_ekonomi', $penerimaBansos->status_ekonomi) == 'miskin' ? 'selected' : '' }}>Miskin</option>
                                    <option value="menengah_bawah" {{ old('status_ekonomi', $penerimaBansos->status_ekonomi) == 'menengah_bawah' ? 'selected' : '' }}>Menengah Bawah</option>
                                    <option value="menengah" {{ old('status_ekonomi', $penerimaBansos->status_ekonomi) == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $penerimaBansos->keterangan) }}</textarea>
                            </div>

                            <hr>
                            <h5 class="mb-3">Dokumen Pendukung</h5>
                            @if($penerimaBansos->dokumen_pendukung && count($penerimaBansos->dokumen_pendukung) > 0)
                                <div class="mb-3">
                                    <label class="form-control-label">Dokumen Saat Ini:</label>
                                    <div class="row">
                                        @foreach($penerimaBansos->dokumen_pendukung as $index => $dokumen)
                                            <div class="col-md-3 mb-2">
                                                <div class="card">
                                                    <div class="card-body p-2 text-center">
                                                        <i class="fa fa-file-pdf fa-2x text-danger"></i>
                                                        <p class="small mb-1">{{ basename($dokumen) }}</p>
                                                        <a href="{{ asset('storage/' . $dokumen) }}" target="_blank" class="btn btn-xs btn-info">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="text-muted">Upload file baru untuk menambahkan dokumen</small>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="form-control-label">Tambah Dokumen Baru (Opsional)</label>
                                <input type="file" name="dokumen_pendukung[]" class="form-control-file" multiple accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">Format: PDF, JPG, PNG (Max: 2MB per file)</small>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('penerima-bansos.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


