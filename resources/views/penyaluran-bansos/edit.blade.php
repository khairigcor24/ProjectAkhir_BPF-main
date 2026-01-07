@extends('layouts.app', ['activePage' => 'penyaluran-bansos', 'title' => 'Edit Penyaluran Bansos', 'navName' => 'Edit Penyaluran', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Penyaluran Bansos</h4>
                        <p class="card-category">Edit data penyaluran</p>
                    </div>
                    <div class="card-body">
                        @include('alerts.errors')

                        <form method="POST" action="{{ route('penyaluran-bansos.update', $penyaluranBansos) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-control-label">Penerima <span class="text-danger">*</span></label>
                                <select name="penerima_bansos_id" id="penerima-select" class="form-control" required onchange="updateProgram(this.value)">
                                    @foreach($penerimaBansos as $penerima)
                                        <option value="{{ $penerima->id }}" 
                                            data-program-id="{{ $penerima->program_bansos_id }}"
                                            {{ old('penerima_bansos_id', $penyaluranBansos->penerima_bansos_id) == $penerima->id ? 'selected' : '' }}>
                                            {{ $penerima->nama_lengkap }} - {{ $penerima->nik }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Program Bansos <span class="text-danger">*</span></label>
                                <input type="hidden" name="program_bansos_id" id="program-input" value="{{ old('program_bansos_id', $penyaluranBansos->program_bansos_id) }}">
                                <input type="text" class="form-control" value="{{ $penyaluranBansos->programBansos->nama_program }}" readonly>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Nominal Diterima (Rp) <span class="text-danger">*</span></label>
                                        <input type="number" name="nominal_diterima" class="form-control" value="{{ old('nominal_diterima', $penyaluranBansos->nominal_diterima) }}" min="0" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Metode Penyaluran <span class="text-danger">*</span></label>
                                        <select name="metode_penyaluran" id="metode-select" class="form-control" required onchange="toggleMetodeFields(this.value)">
                                            <option value="transfer" {{ old('metode_penyaluran', $penyaluranBansos->metode_penyaluran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                            <option value="tunai" {{ old('metode_penyaluran', $penyaluranBansos->metode_penyaluran) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                            <option value="voucher" {{ old('metode_penyaluran', $penyaluranBansos->metode_penyaluran) == 'voucher' ? 'selected' : '' }}>Voucher</option>
                                            <option value="barang" {{ old('metode_penyaluran', $penyaluranBansos->metode_penyaluran) == 'barang' ? 'selected' : '' }}>Barang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="rekening-fields" style="display: {{ old('metode_penyaluran', $penyaluranBansos->metode_penyaluran) == 'transfer' ? 'block' : 'none' }};">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">No Rekening</label>
                                            <input type="text" name="no_rekening" class="form-control" value="{{ old('no_rekening', $penyaluranBansos->no_rekening) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Nama Bank</label>
                                            <input type="text" name="nama_bank" class="form-control" value="{{ old('nama_bank', $penyaluranBansos->nama_bank) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Tanggal Penyaluran <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_penyaluran" class="form-control" value="{{ old('tanggal_penyaluran', $penyaluranBansos->tanggal_penyaluran->format('Y-m-d')) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" required>
                                            <option value="dijadwalkan" {{ old('status', $penyaluranBansos->status) == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                            <option value="diproses" {{ old('status', $penyaluranBansos->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="disalurkan" {{ old('status', $penyaluranBansos->status) == 'disalurkan' ? 'selected' : '' }}>Disalurkan</option>
                                            <option value="gagal" {{ old('status', $penyaluranBansos->status) == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Bukti Penyaluran</label>
                                @if($penyaluranBansos->bukti_penyaluran)
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $penyaluranBansos->bukti_penyaluran) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i> Lihat Bukti Saat Ini
                                        </a>
                                    </div>
                                @endif
                                <input type="file" name="bukti_penyaluran" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah bukti</small>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Catatan</label>
                                <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $penyaluranBansos->catatan) }}</textarea>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('penyaluran-bansos.index') }}" class="btn btn-secondary">Batal</a>
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

@push('js')
<script>
    function updateProgram(penerimaId) {
        const select = document.getElementById('penerima-select');
        const option = select.options[select.selectedIndex];
        const programId = option.getAttribute('data-program-id');
        document.getElementById('program-input').value = programId;
    }

    function toggleMetodeFields(metode) {
        const rekeningFields = document.getElementById('rekening-fields');
        if (metode === 'transfer') {
            rekeningFields.style.display = 'block';
        } else {
            rekeningFields.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const metodeSelect = document.getElementById('metode-select');
        if (metodeSelect.value) {
            toggleMetodeFields(metodeSelect.value);
        }
    });
</script>
@endpush

