@extends(auth()->check() && auth()->user()->isAdmin() ? 'layouts.app' : 'layouts.public', [
    'activePage' => 'penerima-bansos', 
    'title' => 'Pendaftaran Penerima Bansos', 
    'navName' => 'Pendaftaran', 
    'activeButton' => 'laravel'
])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Pendaftaran Penerima Bansos</h4>
                        <p class="card-category">Lengkapi data diri Anda untuk mendaftar sebagai penerima bansos</p>
                    </div>
                    <div class="card-body">
                        @include('alerts.errors')

                        <form method="POST" action="{{ auth()->check() && auth()->user()->isAdmin() ? route('penerima-bansos.store') : route('guest.penerima-bansos.store') }}" enctype="multipart/form-data">
                            @csrf

                            <h5 class="mb-3">Informasi Program</h5>
                            <div class="form-group{{ $errors->has('program_bansos_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Pilih Program Bansos <span class="text-danger">*</span></label>
                                <select name="program_bansos_id" class="form-control{{ $errors->has('program_bansos_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">-- Pilih Program --</option>
                                    @foreach($programBansos as $program)
                                        @if($program->status == 'aktif' && $program->hasQuota())
                                            <option value="{{ $program->id }}" {{ old('program_bansos_id') == $program->id ? 'selected' : '' }}>
                                                {{ $program->nama_program }} (Kuota tersisa: {{ $program->kuota_tersisa }})
                                            </option>
                                        @endif
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
                                        <input type="text" name="nik" class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}" value="{{ old('nik') }}" maxlength="16" required>
                                        <small class="form-text text-muted">16 digit NIK</small>
                                        @include('alerts.feedback', ['field' => 'nik'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama_lengkap') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" class="form-control{{ $errors->has('nama_lengkap') ? ' is-invalid' : '' }}" value="{{ old('nama_lengkap') }}" required>
                                        @include('alerts.feedback', ['field' => 'nama_lengkap'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}" value="{{ old('tempat_lahir') }}">
                                        @include('alerts.feedback', ['field' => 'tempat_lahir'])
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tanggal_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}" value="{{ old('tanggal_lahir') }}">
                                        @include('alerts.feedback', ['field' => 'tanggal_lahir'])
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}">
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @include('alerts.feedback', ['field' => 'jenis_kelamin'])
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="mb-3">Alamat</h5>
                            <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" rows="3" required>{{ old('alamat') }}</textarea>
                                @include('alerts.feedback', ['field' => 'alamat'])
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('rt') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">RT</label>
                                        <input type="text" name="rt" class="form-control{{ $errors->has('rt') ? ' is-invalid' : '' }}" value="{{ old('rt') }}">
                                        @include('alerts.feedback', ['field' => 'rt'])
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('rw') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">RW</label>
                                        <input type="text" name="rw" class="form-control{{ $errors->has('rw') ? ' is-invalid' : '' }}" value="{{ old('rw') }}">
                                        @include('alerts.feedback', ['field' => 'rw'])
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('kelurahan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Kelurahan</label>
                                        <input type="text" name="kelurahan" class="form-control{{ $errors->has('kelurahan') ? ' is-invalid' : '' }}" value="{{ old('kelurahan') }}">
                                        @include('alerts.feedback', ['field' => 'kelurahan'])
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('kecamatan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Kecamatan</label>
                                        <input type="text" name="kecamatan" class="form-control{{ $errors->has('kecamatan') ? ' is-invalid' : '' }}" value="{{ old('kecamatan') }}">
                                        @include('alerts.feedback', ['field' => 'kecamatan'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('kota_kabupaten') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Kota/Kabupaten</label>
                                        <input type="text" name="kota_kabupaten" class="form-control{{ $errors->has('kota_kabupaten') ? ' is-invalid' : '' }}" value="{{ old('kota_kabupaten') }}">
                                        @include('alerts.feedback', ['field' => 'kota_kabupaten'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('provinsi') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Provinsi</label>
                                        <input type="text" name="provinsi" class="form-control{{ $errors->has('provinsi') ? ' is-invalid' : '' }}" value="{{ old('provinsi') }}">
                                        @include('alerts.feedback', ['field' => 'provinsi'])
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="mb-3">Kontak & Informasi Ekonomi</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('telepon') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Telepon</label>
                                        <input type="text" name="telepon" class="form-control{{ $errors->has('telepon') ? ' is-invalid' : '' }}" value="{{ old('telepon') }}">
                                        @include('alerts.feedback', ['field' => 'telepon'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Email</label>
                                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                                        @include('alerts.feedback', ['field' => 'email'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('jumlah_anggota_keluarga') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Jumlah Anggota Keluarga</label>
                                        <input type="number" name="jumlah_anggota_keluarga" class="form-control{{ $errors->has('jumlah_anggota_keluarga') ? ' is-invalid' : '' }}" value="{{ old('jumlah_anggota_keluarga', 1) }}" min="1">
                                        @include('alerts.feedback', ['field' => 'jumlah_anggota_keluarga'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('penghasilan_perbulan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Penghasilan per Bulan (Rp)</label>
                                        <input type="number" name="penghasilan_perbulan" class="form-control{{ $errors->has('penghasilan_perbulan') ? ' is-invalid' : '' }}" value="{{ old('penghasilan_perbulan') }}" min="0" step="0.01">
                                        @include('alerts.feedback', ['field' => 'penghasilan_perbulan'])
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('status_ekonomi') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Status Ekonomi</label>
                                <select name="status_ekonomi" class="form-control{{ $errors->has('status_ekonomi') ? ' is-invalid' : '' }}">
                                    <option value="">-- Pilih --</option>
                                    <option value="sangat_miskin" {{ old('status_ekonomi') == 'sangat_miskin' ? 'selected' : '' }}>Sangat Miskin</option>
                                    <option value="miskin" {{ old('status_ekonomi') == 'miskin' ? 'selected' : '' }}>Miskin</option>
                                    <option value="menengah_bawah" {{ old('status_ekonomi') == 'menengah_bawah' ? 'selected' : '' }}>Menengah Bawah</option>
                                    <option value="menengah" {{ old('status_ekonomi') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'status_ekonomi'])
                            </div>

                            <div class="form-group{{ $errors->has('keterangan') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Keterangan Tambahan</label>
                                <textarea name="keterangan" class="form-control{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" rows="3" placeholder="Keterangan tambahan tentang kondisi ekonomi atau alasan membutuhkan bantuan">{{ old('keterangan') }}</textarea>
                                @include('alerts.feedback', ['field' => 'keterangan'])
                            </div>

                            <hr>
                            <h5 class="mb-3">Dokumen Pendukung</h5>
                            <div class="form-group{{ $errors->has('dokumen_pendukung') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Upload Dokumen Pendukung</label>
                                <input type="file" name="dokumen_pendukung[]" class="form-control-file{{ $errors->has('dokumen_pendukung') ? ' is-invalid' : '' }}" multiple accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">
                                    Format: PDF, JPG, PNG (Max: 2MB per file). Bisa upload multiple file (KTP, KK, Surat Keterangan, dll)
                                </small>
                                @include('alerts.feedback', ['field' => 'dokumen_pendukung'])
                            </div>

                            <div class="card-footer">
                                <a href="{{ auth()->check() && auth()->user()->isAdmin() ? route('penerima-bansos.index') : '/' }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


