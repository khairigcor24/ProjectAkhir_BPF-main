@extends('layouts.app', ['activePage' => 'program-bansos', 'title' => 'Tambah Program Bansos', 'navName' => 'Tambah Program Bansos', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Program Bansos</h4>
                        <p class="card-category">Buat program bantuan sosial baru</p>
                    </div>
                    <div class="card-body">
                        @include('alerts.errors')

                        <form method="POST" action="{{ route('program-bansos.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group{{ $errors->has('nama_program') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Nama Program <span class="text-danger">*</span></label>
                                <input type="text" name="nama_program" class="form-control{{ $errors->has('nama_program') ? ' is-invalid' : '' }}" value="{{ old('nama_program') }}" required>
                                @include('alerts.feedback', ['field' => 'nama_program'])
                            </div>

                            <div class="form-group{{ $errors->has('deskripsi') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" rows="4" required>{{ old('deskripsi') }}</textarea>
                                @include('alerts.feedback', ['field' => 'deskripsi'])
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('kuota') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Kuota <span class="text-danger">*</span></label>
                                        <input type="number" name="kuota" class="form-control{{ $errors->has('kuota') ? ' is-invalid' : '' }}" value="{{ old('kuota') }}" min="1" required>
                                        @include('alerts.feedback', ['field' => 'kuota'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nominal_bantuan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Nominal Bantuan (Rp)</label>
                                        <input type="number" name="nominal_bantuan" class="form-control{{ $errors->has('nominal_bantuan') ? ' is-invalid' : '' }}" value="{{ old('nominal_bantuan') }}" min="0" step="0.01">
                                        @include('alerts.feedback', ['field' => 'nominal_bantuan'])
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('tanggal_mulai') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_mulai" class="form-control{{ $errors->has('tanggal_mulai') ? ' is-invalid' : '' }}" value="{{ old('tanggal_mulai') }}" required>
                                        @include('alerts.feedback', ['field' => 'tanggal_mulai'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('tanggal_selesai') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control{{ $errors->has('tanggal_selesai') ? ' is-invalid' : '' }}" value="{{ old('tanggal_selesai') }}">
                                        @include('alerts.feedback', ['field' => 'tanggal_selesai'])
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gambar') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Gambar Program</label>
                                <input type="file" name="gambar" class="form-control-file{{ $errors->has('gambar') ? ' is-invalid' : '' }}" accept="image/*">
                                <small class="form-text text-muted">Format: JPG, PNG, GIF (Max: 2MB)</small>
                                @include('alerts.feedback', ['field' => 'gambar'])
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                <label class="form-control-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'status'])
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('program-bansos.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


