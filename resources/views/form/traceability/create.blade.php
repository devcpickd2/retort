@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4">
                <i class="bi bi-plus-circle"></i> Form Input Laporan Traceability
            </h4>

            <form id="traceabilityForm" method="POST" action="{{ route('traceability.store') }}">
                @csrf

                {{-- ===================== MAIN INFO ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Traceability</strong>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label fw-bold">Tanggal</label>
                            <div class="col-md-9">
                                <input type="date" name="date" id="dateInput"
                                class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date', now()->format('Y-m-d')) }}" required>
                                @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===================== TABS ===================== --}}
                <ul class="nav nav-tabs mb-3" id="traceTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-penyebab"
                        data-bs-toggle="tab" data-bs-target="#content-penyebab"
                        type="button" role="tab">
                        Penyebab Telusur
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-pangan"
                    data-bs-toggle="tab" data-bs-target="#content-pangan"
                    type="button" role="tab">
                    Informasi Pangan
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-data"
                data-bs-toggle="tab" data-bs-target="#content-data"
                type="button" role="tab">
                Data Trace
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-kesimpulan"
            data-bs-toggle="tab" data-bs-target="#content-kesimpulan"
            type="button" role="tab">
            Kesimpulan
        </button>
    </li>
</ul>

{{-- ===================== TAB CONTENT ===================== --}}
<div class="tab-content">

    {{-- ===================== TAB 1: Penyebab ===================== --}}
    <div class="tab-pane fade show active" id="content-penyebab" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <strong>Informasi Penyebab Telusur</strong>
            </div>

            <div class="card-body">
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Penyebab Telusur</label>
                    <div class="col-md-9">
                        <input type="text" name="penyebab"
                        class="form-control @error('penyebab') is-invalid @enderror"
                        value="{{ old('penyebab') }}">
                        @error('penyebab') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Asal Informasi (Tahapan Proses)</label>
                    <div class="col-md-9">
                        <input type="text" name="asal_informasi"
                        class="form-control @error('asal_informasi') is-invalid @enderror"
                        value="{{ old('asal_informasi') }}">
                        @error('asal_informasi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== TAB 2: Informasi Pangan ===================== --}}
    <div class="tab-pane fade" id="content-pangan" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <strong>Informasi Pangan</strong>
            </div>

            <div class="card-body">

                {{-- field-field pangan --}}
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Jenis Pangan</label>
                    <div class="col-md-9">
                        <input type="text" name="jenis_pangan"
                        class="form-control @error('jenis_pangan') is-invalid @enderror"
                        value="{{ old('jenis_pangan') }}">
                        @error('jenis_pangan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Nama Dagang</label>
                    <div class="col-md-9">
                        <input type="text" name="nama_dagang"
                        class="form-control @error('nama_dagang') is-invalid @enderror"
                        value="{{ old('nama_dagang') }}">
                        @error('nama_dagang') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Berat / Isi Bersih</label>
                    <div class="col-md-9">
                        <input type="number" name="berat_bersih"
                        class="form-control @error('berat_bersih') is-invalid @enderror"
                        value="{{ old('berat_bersih') }}">
                        @error('berat_bersih') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Jenis Kemasan</label>
                    <div class="col-md-9">
                        <input type="text" name="jenis_kemasan"
                        class="form-control @error('jenis_kemasan') is-invalid @enderror"
                        value="{{ old('jenis_kemasan') }}">
                        @error('jenis_kemasan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Kode Produksi</label>
                    <div class="col-md-9">
                        <input type="text" name="kode_produksi"
                        class="form-control @error('kode_produksi') is-invalid @enderror"
                        value="{{ old('kode_produksi') }}">
                        @error('kode_produksi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Tanggal Produksi</label>
                    <div class="col-md-9">
                        <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                        value="{{ old('tanggal_produksi') }}" required>
                        @error('tanggal_produksi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Tanggal Kadaluarsa</label>
                    <div class="col-md-9">
                        <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa"
                        class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                        value="{{ old('tanggal_kadaluarsa') }}" required>
                        @error('tanggal_kadaluarsa') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Nomor Pendaftaran Pangan</label>
                    <div class="col-md-9">
                        <input type="text" name="no_pendaftaran"
                        class="form-control @error('no_pendaftaran') is-invalid @enderror"
                        value="{{ old('no_pendaftaran') }}">
                        @error('no_pendaftaran') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Jumlah Produksi</label>
                    <div class="col-md-9">
                        <input type="number" name="jumlah_produksi"
                        class="form-control @error('jumlah_produksi') is-invalid @enderror"
                        value="{{ old('jumlah_produksi') }}">
                        @error('jumlah_produksi') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-md-3 col-form-label fw-bold">Rencana Tindak Lanjut</label>
                    <div class="col-md-9">
                        <input type="text" name="tindak_lanjut"
                        class="form-control @error('tindak_lanjut') is-invalid @enderror"
                        value="{{ old('tindak_lanjut') }}">
                        @error('tindak_lanjut') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ===================== TAB 3: Data Trace ===================== --}}
    <div class="tab-pane fade" id="content-data" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header bg-info text-white d-flex justify-content-between">
                <strong>Data Trace</strong>
                <button type="button" id="addRow" class="btn btn-light btn-sm text-primary fw-bold">
                    + Tambah Form
                </button>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Laporan</th>
                            <th>No. Dokumen</th>
                            <th>Kelengkapan</th>
                            <th>Waktu Telusur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="traceForm">

                        {{-- Row Default --}}
                        <tr>
                            <td>
                                <select name="kelengkapan_form[0][laporan]"
                                class="form-control form-control-sm laporan-select"
                                data-index="0">
                                <option value="">-- Pilih Laporan --</option>
                                @foreach ($forms as $lf)
                                <option value="{{ $lf->laporan }}"
                                    data-no-dokumen="{{ $lf->no_dokumen }}">
                                    {{ $lf->laporan }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="kelengkapan_form[0][no_dokumen]"
                            class="form-control form-control-sm no-dokumen-input" readonly>
                        </td>
                        <td>
                            <select name="kelengkapan_form[0][kelengkapan]"
                            class="form-control form-control-sm">
                            <option value="">-- Pilih Status --</option>
                            <option value="Lengkap">Lengkap</option>
                            <option value="Tidak Lengkap">Tidak Lengkap</option>
                        </select>
                    </td>
                    <td>
                        <input type="time" name="kelengkapan_form[0][waktu_telusur]"
                        class="form-control form-control-sm waktu-telusur" step="60">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                    </td>
                </tr>

                {{-- TOTAL --}}
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total Waktu Telusur:</td>
                    <td colspan="2">
                        <input type="text" id="total_waktu" name="total_waktu" 
                        class="form-control form-control-sm" readonly>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
</div>

{{-- ===================== TAB 4: Kesimpulan ===================== --}}
<div class="tab-pane fade" id="content-kesimpulan" role="tabpanel">
    <div class="card mb-4">
        <div class="card-header bg-light">
            <strong>Dari hasil Traceability yang telah dilakukan, dapat disimpulkan:</strong>
        </div>

        <div class="card-body">
            <textarea name="kesimpulan" class="form-control" rows="10"
            placeholder="Tulis Kesimpulan...">{{ old('kesimpulan') }}</textarea>
        </div>
    </div>
</div>

</div>

{{-- ===================== BUTTONS ===================== --}}
<div class="d-flex justify-content-between mt-3">
    <button type="submit" class="btn btn-success">
        <i class="bi bi-save"></i> Simpan
    </button>

    <a href="{{ route('traceability.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

</form>

</div>
</div>
</div>

{{-- ===================== ASSETS ===================== --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

{{-- ===================== SCRIPT ===================== --}}
<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });

    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("dateInput").value = new Date().toISOString().slice(0, 10);
    });

    document.querySelectorAll('.waktu-telusur').forEach(el => {
        el.addEventListener('input', function() {
            let val = this.value;
        // Format selalu HH:MM, tidak pakai AM/PM
            if (/^\d{1}:\d{2}$/.test(val)) {
                this.value = "0" + val; 
            }
        });
    });

    document.getElementById('tanggal_produksi').addEventListener('change', function () {
        let produksi = new Date(this.value);

        if (!isNaN(produksi.getTime())) {
            let kadaluarsa = new Date(produksi);
            kadaluarsa.setMonth(kadaluarsa.getMonth() + 7);

            let tahun = kadaluarsa.getFullYear();
            let bulan = String(kadaluarsa.getMonth() + 1).padStart(2, '0');
            let hari = String(kadaluarsa.getDate()).padStart(2, '0');

            document.getElementById('tanggal_kadaluarsa').value = `${tahun}-${bulan}-${hari}`;
        }
    });
</script>
<script>
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('laporan-select')) {
            let selected = e.target.options[e.target.selectedIndex];
            let noDokumen = selected.getAttribute('data-no-dokumen');

            let rowIndex = e.target.getAttribute('data-index');
            document.querySelector(`input[name="kelengkapan_form[${rowIndex}][no_dokumen]"]`).value = noDokumen ?? '';
        }
    });
</script>
<script>
let rowIndex = 1; // karena row pertama index 0

// === Fungsi Tambah Baris ===
document.getElementById('addRow').addEventListener('click', function () {

    let newRow = `
        <tr>
            <td>
                <select name="kelengkapan_form[${rowIndex}][laporan]"
                        class="form-control form-control-sm laporan-select"
                        data-index="${rowIndex}">
                    <option value="">-- Pilih Laporan --</option>
                    @foreach ($forms as $lf)
                    <option value="{{ $lf->laporan }}" data-no-dokumen="{{ $lf->no_dokumen }}">
                        {{ $lf->laporan }}
                    </option>
                    @endforeach
                </select>
            </td>

            <td>
                <input type="text" name="kelengkapan_form[${rowIndex}][no_dokumen]"
                       class="form-control form-control-sm no-dokumen-input"
                       readonly>
            </td>

            <td>
                <select name="kelengkapan_form[${rowIndex}][kelengkapan]"
                        class="form-control form-control-sm">
                    <option value="">-- Pilih Status --</option>
                    <option value="Lengkap">Lengkap</option>
                    <option value="Tidak Lengkap">Tidak Lengkap</option>
                </select>
            </td>

            <td>
                <input type="time" name="kelengkapan_form[${rowIndex}][waktu_telusur]"
                       class="form-control form-control-sm waktu-telusur">
            </td>

            <td>
                <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
            </td>
        </tr>
    `;

    const totalRow = document.querySelector('#traceForm tr:last-child');
    totalRow.insertAdjacentHTML('beforebegin', newRow);
    rowIndex++;
});

// === Fungsi Hapus Baris ===
document.addEventListener('click', function(e){
    if (e.target.classList.contains('removeRow')) {
        e.target.closest('tr').remove();
        hitungTotalWaktu();
    }
});

// === Auto Isi No Dokumen Berdasarkan Laporan ===
document.addEventListener('change', function(e){
    if (e.target.classList.contains('laporan-select')) {
        let selected = e.target.options[e.target.selectedIndex];
        let noDok = selected.getAttribute('data-no-dokumen');
        let idx = e.target.getAttribute('data-index');

        document.querySelector(`input[name="kelengkapan_form[${idx}][no_dokumen]"]`).value = noDok ?? '';
    }
});

// === Hitung Total Waktu Telusur ===
function hitungTotalWaktu() {
    let totalMenit = 0;

    document.querySelectorAll('.waktu-telusur').forEach(input => {
        if (input.value) {
            let [jam, menit] = input.value.split(':');
            totalMenit += (+jam * 60) + (+menit);
        }
    });

    let totalJam = Math.floor(totalMenit / 60);
    let sisaMenit = totalMenit % 60;

    document.getElementById('total_waktu').value = `${totalJam} jam ${sisaMenit} menit`;
}

document.addEventListener('input', function(e){
    if (e.target.classList.contains('waktu-telusur')) {
        hitungTotalWaktu();
    }
});
</script>


@endsection
