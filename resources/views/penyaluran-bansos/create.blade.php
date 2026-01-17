@extends('layouts.app', ['activePage' => 'penyaluran-bansos', 'title' => 'Tambah Penyaluran Bansos', 'navName' => 'Tambah Penyaluran', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Penyaluran Bansos</h4>
                            <p class="card-category">Rekam penyaluran bantuan kepada penerima</p>
                        </div>
                        <div class="card-body">
                            @include('alerts.errors')

                            <form method="POST" action="{{ route('penyaluran-bansos.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group{{ $errors->has('penerima_bansos_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">Pilih Penerima <span
                                            class="text-danger">*</span></label>
                                    <select name="penerima_bansos_id" id="penerima-select"
                                        class="form-control{{ $errors->has('penerima_bansos_id') ? ' is-invalid' : '' }}"
                                        required onchange="updateProgram(this.value)">
                                        <option value="">-- Pilih Penerima --</option>
                                        @foreach ($penerimaBansos as $penerima)
                                            <option value="{{ $penerima->id }}"
                                                data-program-id="{{ $penerima->program_bansos_id }}"
                                                {{ old('penerima_bansos_id') == $penerima->id ? 'selected' : '' }}>
                                                {{ $penerima->nama_lengkap }} - {{ $penerima->nik }}
                                                ({{ $penerima->programBansos->nama_program }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'penerima_bansos_id'])
                                </div>

                                <div class="form-group{{ $errors->has('program_bansos_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">Program Bansos <span
                                            class="text-danger">*</span></label>
                                    <select id="program-select" class="form-control" disabled>
                                        <option value="">-- Akan terisi otomatis --</option>
                                    </select>

                                    <input type="hidden" name="program_bansos_id" id="program-hidden">

                                    @include('alerts.feedback', ['field' => 'program_bansos_id'])
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('nominal_diterima') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">Nominal Diterima (Rp) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="nominal_diterima"
                                                class="form-control{{ $errors->has('nominal_diterima') ? ' is-invalid' : '' }}"
                                                value="{{ old('nominal_diterima') }}" min="0" step="1"
                                                required>
                                            @include('alerts.feedback', ['field' => 'nominal_diterima'])
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group{{ $errors->has('metode_penyaluran') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">Metode Penyaluran <span
                                                    class="text-danger">*</span></label>
                                            <select name="metode_penyaluran" id="metode-select"
                                                class="form-control{{ $errors->has('metode_penyaluran') ? ' is-invalid' : '' }}"
                                                required onchange="toggleMetodeFields(this.value)">
                                                <option value="">-- Pilih Metode --</option>
                                                <option value="transfer"
                                                    {{ old('metode_penyaluran') == 'transfer' ? 'selected' : '' }}>Transfer
                                                </option>
                                                <option value="tunai"
                                                    {{ old('metode_penyaluran') == 'tunai' ? 'selected' : '' }}>Tunai
                                                </option>
                                                <option value="voucher"
                                                    {{ old('metode_penyaluran') == 'voucher' ? 'selected' : '' }}>Voucher
                                                </option>
                                                <option value="barang"
                                                    {{ old('metode_penyaluran') == 'barang' ? 'selected' : '' }}>Barang
                                                </option>
                                            </select>
                                            @include('alerts.feedback', ['field' => 'metode_penyaluran'])
                                        </div>
                                    </div>
                                </div>

                                <div id="rekening-fields" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('no_rekening') ? ' has-danger' : '' }}">
                                                <label class="form-control-label">No Rekening <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="no_rekening"
                                                    class="form-control{{ $errors->has('no_rekening') ? ' is-invalid' : '' }}"
                                                    value="{{ old('no_rekening') }}">
                                                @include('alerts.feedback', ['field' => 'no_rekening'])
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('nama_bank') ? ' has-danger' : '' }}">
                                                <label class="form-control-label">Nama Bank <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="nama_bank"
                                                    class="form-control{{ $errors->has('nama_bank') ? ' is-invalid' : '' }}"
                                                    value="{{ old('nama_bank') }}">
                                                @include('alerts.feedback', ['field' => 'nama_bank'])
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div
                                            class="form-group{{ $errors->has('tanggal_penyaluran') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">Tanggal Penyaluran <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="tanggal_penyaluran"
                                                class="form-control{{ $errors->has('tanggal_penyaluran') ? ' is-invalid' : '' }}"
                                                value="{{ old('tanggal_penyaluran', date('Y-m-d')) }}" required>
                                            @include('alerts.feedback', ['field' => 'tanggal_penyaluran'])
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                            <label class="form-control-label">Status <span
                                                    class="text-danger">*</span></label>
                                            <select name="status"
                                                class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                required>
                                                <option value="dijadwalkan"
                                                    {{ old('status') == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan
                                                </option>
                                                <option value="diproses"
                                                    {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="disalurkan"
                                                    {{ old('status') == 'disalurkan' ? 'selected' : '' }}>Disalurkan
                                                </option>
                                                <option value="gagal" {{ old('status') == 'gagal' ? 'selected' : '' }}>
                                                    Gagal</option>
                                            </select>
                                            @include('alerts.feedback', ['field' => 'status'])
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('bukti_penyaluran') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">Bukti Penyaluran</label>
                                    <input type="file" name="bukti_penyaluran"
                                        class="form-control-file{{ $errors->has('bukti_penyaluran') ? ' is-invalid' : '' }}"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="form-text text-muted">Format: PDF, JPG, PNG (Max: 2MB)</small>
                                    @include('alerts.feedback', ['field' => 'bukti_penyaluran'])
                                </div>

                                <div class="form-group{{ $errors->has('catatan') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">Catatan</label>
                                    <textarea name="catatan" class="form-control{{ $errors->has('catatan') ? ' is-invalid' : '' }}" rows="3"
                                        placeholder="Catatan tentang penyaluran (opsional)">{{ old('catatan') }}</textarea>
                                    @include('alerts.feedback', ['field' => 'catatan'])
                                </div>

                                <div class="card-footer">
                                    <a href="{{ route('penyaluran-bansos.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary" id="btn-submit">
                                        Simpan
                                    </button>
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
    function updateProgram() {
        const select = document.getElementById('penerima-select');
        const option = select.options[select.selectedIndex];
        const programId = option.getAttribute('data-program-id');
        const programName = option.text.split('(')[1]?.replace(')', '');

        const programSelect = document.getElementById('program-select');
        const programHidden = document.getElementById('program-hidden');

        programSelect.innerHTML = '';

        if (programId) {
            const opt = document.createElement('option');
            opt.value = programId;
            opt.text = programName ?? 'Program terpilih';
            opt.selected = true;
            programSelect.appendChild(opt);

            programHidden.value = programId;
        }
    }

    function toggleMetodeFields(metode) {
        const rekeningFields = document.getElementById('rekening-fields');
        rekeningFields.style.display = metode === 'transfer' ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('penerima-select').value) {
            updateProgram();
        }

        if (document.getElementById('metode-select').value) {
            toggleMetodeFields(document.getElementById('metode-select').value);
        }

        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.innerHTML = 'Menyimpan...';
        });
    });
</script>
@endpush

