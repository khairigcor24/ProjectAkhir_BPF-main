@extends('layouts.app', ['activePage' => 'donasi', 'title' => 'SEJAHTERA', 'navName' => 'Daftar Donasi'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Form Pendaftaran Donasi') }}</h4>
                            <p class="card-category">{{ __('Isi form di bawah ini untuk mendaftarkan donasi Anda') }}</p>
                        </div>
                        <div class="card-body">
                            @include('alerts.success', ['key' => 'success'])
                            @include('alerts.errors')

                            <form method="POST" action="{{ route('guest.donasi.store') }}">
                                @csrf

                                <div class="form-group{{ $errors->has('nama_donatur') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-nama">{{ __('Nama Donatur') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_donatur" id="input-nama" class="form-control{{ $errors->has('nama_donatur') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Lengkap') }}" value="{{ old('nama_donatur') }}" required>
                                    @include('alerts.feedback', ['field' => 'nama_donatur'])
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('email@example.com') }}" value="{{ old('email') }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>

                                <div class="form-group{{ $errors->has('telepon') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-telepon">{{ __('Telepon') }}</label>
                                    <input type="text" name="telepon" id="input-telepon" class="form-control{{ $errors->has('telepon') ? ' is-invalid' : '' }}" placeholder="{{ __('08xxxxxxxxxx') }}" value="{{ old('telepon') }}">
                                    @include('alerts.feedback', ['field' => 'telepon'])
                                </div>

                                <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-alamat">{{ __('Alamat') }}</label>
                                    <textarea name="alamat" id="input-alamat" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" rows="3" placeholder="{{ __('Alamat Lengkap') }}">{{ old('alamat') }}</textarea>
                                    @include('alerts.feedback', ['field' => 'alamat'])
                                </div>

                                <div class="form-group{{ $errors->has('jenis_donasi') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-jenis">{{ __('Jenis Donasi') }} <span class="text-danger">*</span></label>
                                    <select name="jenis_donasi" id="input-jenis" class="form-control{{ $errors->has('jenis_donasi') ? ' is-invalid' : '' }}" required onchange="toggleJenisDonasi(this.value)">
                                        <option value="">{{ __('Pilih Jenis Donasi') }}</option>
                                        <option value="uang" {{ old('jenis_donasi') == 'uang' ? 'selected' : '' }}>{{ __('Uang') }}</option>
                                        <option value="barang" {{ old('jenis_donasi') == 'barang' ? 'selected' : '' }}>{{ __('Barang') }}</option>
                                        <option value="jasa" {{ old('jenis_donasi') == 'jasa' ? 'selected' : '' }}>{{ __('Jasa') }}</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'jenis_donasi'])
                                </div>

                                <div class="form-group{{ $errors->has('jumlah') ? ' has-danger' : '' }}" id="jumlah-field" style="display: none;">
                                    <label class="form-control-label" for="input-jumlah">{{ __('Jumlah (Rupiah)') }}</label>
                                    <input type="number" name="jumlah" id="input-jumlah" class="form-control{{ $errors->has('jumlah') ? ' is-invalid' : '' }}" placeholder="{{ __('0') }}" value="{{ old('jumlah') }}" min="0" step="1000">
                                    @include('alerts.feedback', ['field' => 'jumlah'])
                                </div>

                                <div class="form-group{{ $errors->has('deskripsi_barang') ? ' has-danger' : '' }}" id="deskripsi-field" style="display: none;">
                                    <label class="form-control-label" for="input-deskripsi">{{ __('Deskripsi Barang/Jasa') }}</label>
                                    <textarea name="deskripsi_barang" id="input-deskripsi" class="form-control{{ $errors->has('deskripsi_barang') ? ' is-invalid' : '' }}" rows="4" placeholder="{{ __('Jelaskan barang atau jasa yang akan didonasikan') }}">{{ old('deskripsi_barang') }}</textarea>
                                    @include('alerts.feedback', ['field' => 'deskripsi_barang'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Kirim Donasi') }}</button>
                                    <a href="{{ route('guest.donasi.search') }}" class="btn btn-default mt-4">{{ __('Cari Donasi') }}</a>
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
            jumlahInput.required = true;
            deskripsiInput.required = false;
        } else if (jenis === 'barang' || jenis === 'jasa') {
            jumlahField.style.display = 'none';
            deskripsiField.style.display = 'block';
            jumlahInput.required = false;
            deskripsiInput.required = true;
        } else {
            jumlahField.style.display = 'none';
            deskripsiField.style.display = 'none';
            jumlahInput.required = false;
            deskripsiInput.required = false;
        }
    }

    // Set initial state
    document.addEventListener('DOMContentLoaded', function() {
        const jenisSelect = document.getElementById('input-jenis');
        if (jenisSelect.value) {
            toggleJenisDonasi(jenisSelect.value);
        }
    });
</script>
@endpush



