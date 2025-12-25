@extends('layouts.app', ['activePage' => 'donasi', 'title' => 'SEJAHTERA', 'navName' => 'Tambah Donasi', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Tambah Donasi') }}</h4>
                            <p class="card-category">{{ __('Hanya Admin yang dapat menambah donasi') }}</p>
                        </div>
                        <div class="card-body">
                            @include('alerts.errors')

                            <form method="POST" action="{{ route('donasi.store') }}">
                                @csrf

                                <div class="form-group{{ $errors->has('nama_donatur') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nama">{{ __('Nama Donatur') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_donatur" id="input-nama" class="form-control{{ $errors->has('nama_donatur') ? ' is-invalid' : '' }}" value="{{ old('nama_donatur') }}" required>
                                    @include('alerts.feedback', ['field' => 'nama_donatur'])
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>

                                <div class="form-group{{ $errors->has('telepon') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-telepon">{{ __('Telepon') }}</label>
                                    <input type="text" name="telepon" id="input-telepon" class="form-control{{ $errors->has('telepon') ? ' is-invalid' : '' }}" value="{{ old('telepon') }}">
                                    @include('alerts.feedback', ['field' => 'telepon'])
                                </div>

                                <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                    <textarea name="alamat" id="input-alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" rows="3">{{ old('alamat') }}</textarea>
                                    @include('alerts.feedback', ['field' => 'alamat'])
                                </div>

                                <div class="form-group{{ $errors->has('jenis_donasi') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-jenis">{{ __('Jenis Donasi') }} <span class="text-danger">*</span></label>
                                    <select name="jenis_donasi" id="input-jenis" class="form-control{{ $errors->has('jenis_donasi') ? ' is-invalid' : '' }}" required onchange="toggleJenisDonasi(this.value)">
                                        <option value="uang" {{ old('jenis_donasi') == 'uang' ? 'selected' : '' }}>{{ __('Uang') }}</option>
                                        <option value="barang" {{ old('jenis_donasi') == 'barang' ? 'selected' : '' }}>{{ __('Barang') }}</option>
                                        <option value="jasa" {{ old('jenis_donasi') == 'jasa' ? 'selected' : '' }}>{{ __('Jasa') }}</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'jenis_donasi'])
                                </div>

                                <div class="form-group{{ $errors->has('jumlah') ? ' has-danger' : '' }}" id="jumlah-field">
                                    <label class="form-control-label" for="input-jumlah">{{ __('Jumlah (Rupiah)') }}</label>
                                    <input type="number" name="jumlah" id="input-jumlah" class="form-control{{ $errors->has('jumlah') ? ' is-invalid' : '' }}" value="{{ old('jumlah') }}" min="0" step="1000">
                                    @include('alerts.feedback', ['field' => 'jumlah'])
                                </div>

                                <div class="form-group{{ $errors->has('deskripsi_barang') ? ' has-danger' : '' }}" id="deskripsi-field" style="display: none;">
                                    <label class="form-control-label" for="input-deskripsi">{{ __('Deskripsi Barang/Jasa') }}</label>
                                    <textarea name="deskripsi_barang" id="input-deskripsi" class="form-control{{ $errors->has('deskripsi_barang') ? ' is-invalid' : '' }}" rows="4">{{ old('deskripsi_barang') }}</textarea>
                                    @include('alerts.feedback', ['field' => 'deskripsi_barang'])
                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select name="status" id="input-status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                        <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>{{ __('Diterima') }}</option>
                                        <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>{{ __('Ditolak') }}</option>
                                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>{{ __('Selesai') }}</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'status'])
                                </div>

                                <div class="form-group{{ $errors->has('catatan') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-catatan">{{ __('Catatan') }}</label>
                                    <textarea name="catatan" id="input-catatan" class="form-control{{ $errors->has('catatan') ? ' is-invalid' : '' }}" rows="3">{{ old('catatan') }}</textarea>
                                    @include('alerts.feedback', ['field' => 'catatan'])
                                </div>

                                <div class="text-center">
                                    <a href="{{ route('donasi.index') }}" class="btn btn-default mt-4">{{ __('Batal') }}</a>
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Simpan') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function toggleJenisDonasi(jenis) {
        const jumlahField = document.getElementById('jumlah-field');
        const deskripsiField = document.getElementById('deskripsi-field');
        const jumlahInput = document.getElementById('input-jumlah');
        const deskripsiInput = document.getElementById('input-deskripsi');

        if (jenis === 'uang') {
            jumlahField.style.display = 'block';
            deskripsiField.style.display = 'none';
        } else {
            jumlahField.style.display = 'none';
            deskripsiField.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const jenisSelect = document.getElementById('input-jenis');
        if (jenisSelect.value) {
            toggleJenisDonasi(jenisSelect.value);
        }
    });
</script>
@endpush
