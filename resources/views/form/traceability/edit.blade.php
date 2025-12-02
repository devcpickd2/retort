@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4">
                <i class="bi bi-pencil-square"></i> Edit Laporan Traceability
            </h4>

            <form id="traceabilityForm" method="POST" action="{{ route('traceability.update', $traceability->uuid) }}">
                @csrf
                @method('PUT')

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
                                value="{{ old('date', $traceability->date) }}" required>
                                @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs mb-3" id="traceTabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#content-penyebab">
                            Penyebab
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#content-pangan">
                            Informasi Pangan
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#content-data">
                            Data Trace
                        </button>
                    </li>

                    <li class="nav-item">
                        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#content-kesimpulan">
                            Kesimpulan
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    {{-- ===================== TAB 1 ===================== --}}
                    <div class="tab-pane fade show active" id="content-penyebab">
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <strong>Informasi Penyebab Telusur</strong>
                            </div>
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Penyebab Telusur</label>
                                    <div class="col-md-9">
                                        <input type="text" name="penyebab" class="form-control"
                                        value="{{ old('penyebab', $traceability->penyebab) }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Asal Informasi</label>
                                    <div class="col-md-9">
                                        <input type="text" name="asal_informasi" class="form-control"
                                        value="{{ old('asal_informasi', $traceability->asal_informasi) }}">
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

                                {{-- Jenis Pangan --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Jenis Pangan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="jenis_pangan"
                                        class="form-control @error('jenis_pangan') is-invalid @enderror"
                                        value="{{ old('jenis_pangan', $traceability->jenis_pangan) }}">
                                        @error('jenis_pangan') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Nama Dagang --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Nama Dagang</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nama_dagang"
                                        class="form-control @error('nama_dagang') is-invalid @enderror"
                                        value="{{ old('nama_dagang', $traceability->nama_dagang) }}">
                                        @error('nama_dagang') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Berat Bersih --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Berat / Isi Bersih</label>
                                    <div class="col-md-9">
                                        <input type="number" name="berat_bersih"
                                        class="form-control @error('berat_bersih') is-invalid @enderror"
                                        value="{{ old('berat_bersih', $traceability->berat_bersih) }}">
                                        @error('berat_bersih') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Jenis Kemasan --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Jenis Kemasan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="jenis_kemasan"
                                        class="form-control @error('jenis_kemasan') is-invalid @enderror"
                                        value="{{ old('jenis_kemasan', $traceability->jenis_kemasan) }}">
                                        @error('jenis_kemasan') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Kode Produksi --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Kode Produksi</label>
                                    <div class="col-md-9">
                                        <input type="text" name="kode_produksi"
                                        class="form-control @error('kode_produksi') is-invalid @enderror"
                                        value="{{ old('kode_produksi', $traceability->kode_produksi) }}">
                                        @error('kode_produksi') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Tanggal Produksi --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Tanggal Produksi</label>
                                    <div class="col-md-9">
                                        <input type="date" name="tanggal_produksi" id="tanggal_produksi"
                                        class="form-control @error('tanggal_produksi') is-invalid @enderror"
                                        value="{{ old('tanggal_produksi', $traceability->tanggal_produksi) }}" required>
                                        @error('tanggal_produksi') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Tanggal Kadaluarsa --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Tanggal Kadaluarsa</label>
                                    <div class="col-md-9">
                                        <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa"
                                        class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                                        value="{{ old('tanggal_kadaluarsa', $traceability->tanggal_kadaluarsa) }}" required>
                                        @error('tanggal_kadaluarsa') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Nomor Pendaftaran --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Nomor Pendaftaran Pangan</label>
                                    <div class="col-md-9">
                                        <input type="text" name="no_pendaftaran"
                                        class="form-control @error('no_pendaftaran') is-invalid @enderror"
                                        value="{{ old('no_pendaftaran', $traceability->no_pendaftaran) }}">
                                        @error('no_pendaftaran') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Jumlah Produksi --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Jumlah Produksi</label>
                                    <div class="col-md-9">
                                        <input type="number" name="jumlah_produksi"
                                        class="form-control @error('jumlah_produksi') is-invalid @enderror"
                                        value="{{ old('jumlah_produksi', $traceability->jumlah_produksi) }}">
                                        @error('jumlah_produksi') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Rencana Tindak Lanjut --}}
                                <div class="row mb-3">
                                    <label class="col-md-3 col-form-label fw-bold">Rencana Tindak Lanjut</label>
                                    <div class="col-md-9">
                                        <input type="text" name="tindak_lanjut"
                                        class="form-control @error('tindak_lanjut') is-invalid @enderror"
                                        value="{{ old('tindak_lanjut', $traceability->tindak_lanjut) }}">
                                        @error('tindak_lanjut') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="content-data">
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white d-flex justify-content-between">
                                <strong>Data Trace</strong>
                                <button type="button" id="addRow" class="btn btn-light btn-sm text-primary fw-bold">
                                    + Tambah
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

                                    <tbody id="traceBody">
                                      @foreach ($traceabilityData as $i => $d)
                                      <tr>
                                        <td>
                                            <select name="kelengkapan_form[{{ $i }}][laporan]"
                                            class="form-control laporan-select" data-index="{{ $i }}">
                                            <option value="">-- Pilih Laporan --</option>
                                            @foreach ($forms as $lf)
                                            <option value="{{ $lf->laporan }}"
                                                data-no-dokumen="{{ $lf->no_dokumen }}"
                                                {{ $lf->laporan == $d['laporan'] ? 'selected' : '' }}>
                                                {{ $lf->laporan }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control no-dokumen-input"
                                        name="kelengkapan_form[{{ $i }}][no_dokumen]"
                                        value="{{ $d['no_dokumen'] }}" readonly>
                                    </td>

                                    <td>
                                        <select name="kelengkapan_form[{{ $i }}][kelengkapan]" class="form-control">
                                            <option value="">-- Pilih --</option>
                                            <option {{ $d['kelengkapan'] == 'Lengkap' ? 'selected':'' }}>Lengkap</option>
                                            <option {{ $d['kelengkapan'] == 'Tidak Lengkap' ? 'selected':'' }}>Tidak Lengkap</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="time" class="form-control waktu-telusur"
                                        name="kelengkapan_form[{{ $i }}][waktu_telusur]"
                                        value="{{ $d['waktu_telusur'] }}">
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Total Waktu Telusur:</td>
                                    <td colspan="2">
                                        <input type="text" id="total_waktu" name="total_waktu" 
                                        class="form-control form-control-sm" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ===================== TAB 4 ===================== --}}
            <div class="tab-pane fade" id="content-kesimpulan">
                <div class="card mb-4">
                    <div class="card-header bg-light"><strong>Kesimpulan</strong></div>
                    <div class="card-body">
                        <textarea name="kesimpulan" class="form-control" rows="10">{{ old('kesimpulan', $traceability->kesimpulan) }}</textarea>
                    </div>
                </div>
            </div>

        </div>

        {{-- ===================== BUTTONS ===================== --}}
        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('traceability.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

    </form>

</div>
</div>
</div>
{{-- ===================== SCRIPT (GANTI SELURUH BAGIAN INI) ===================== --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {

    // ========== SET DEFAULT DATE (JANGAN TIMPAH VALUE EDIT) ==========
        const dateInput = document.getElementById("dateInput");
        if (dateInput && !dateInput.value) {
            dateInput.value = new Date().toISOString().slice(0, 10);
        }

    // ========== AUTO KADALUARSA ==========
        const tglProd = document.getElementById('tanggal_produksi');
        const tglKdl = document.getElementById('tanggal_kadaluarsa');
        if (tglProd && tglKdl) {
            tglProd.addEventListener('change', e => {
                let d = new Date(e.target.value);
                if (!isNaN(d)) {
                    d.setMonth(d.getMonth() + 7);
                    tglKdl.value = d.toISOString().slice(0, 10);
                }
            });
        }

    // ========== AUTO FORMAT HH:MM & HITUNG TOTAL ON INPUT ==========
        document.addEventListener("input", e => {
            if (e.target && e.target.classList.contains('waktu-telusur')) {
                let v = e.target.value;
            // jika ada format H:MM (1:05) ubah jadi 01:05
                if (/^\d{1}:\d{2}$/.test(v)) {
                    e.target.value = "0" + v;
                }
                hitungTotal();
            }
        });

    // ========== AMBIL ROW INDEX DARI DATA EXISTING (AMAN) ==========
    // gunakan count dari PHP agar tidak menyebabkan JS syntax error
        let rowIndex = {{ count($traceabilityData ?? []) }};

    // ========== TAMBAH ROW ==========
        const addBtn = document.getElementById('addRow');
        if (addBtn) {
            addBtn.addEventListener('click', () => {
            // template row baru (Blade akan render options saat server-side)
                let tpl = `
            <tr>
                <td>
                    <select name="kelengkapan_form[${rowIndex}][laporan]"
                            class="form-control laporan-select"
                            data-index="${rowIndex}">
                        <option value="">-- Pilih --</option>
                        @foreach ($forms as $lf)
                        <option value="{{ $lf->laporan }}" data-no-dokumen="{{ $lf->no_dokumen }}">
                            {{ $lf->laporan }}
                        </option>
                        @endforeach
                    </select>
                </td>

                <td><input readonly class="form-control no-dokumen-input"
                    name="kelengkapan_form[${rowIndex}][no_dokumen]"></td>

                <td>
                    <select name="kelengkapan_form[${rowIndex}][kelengkapan]" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="Lengkap">Lengkap</option>
                        <option value="Tidak Lengkap">Tidak Lengkap</option>
                    </select>
                </td>

                <td>
                    <input type="time" class="form-control waktu-telusur"
                    name="kelengkapan_form[${rowIndex}][waktu_telusur]" step="60">
                </td>

                <td>
                    <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                </td>
                </tr>`;

            // insert sebelum akhir tbody #traceBody (tfoot tetap di bawah karena berada di <tfoot>)
                const traceBody = document.querySelector("#traceBody");
                if (traceBody) {
                    traceBody.insertAdjacentHTML('beforeend', tpl);
                    rowIndex++;
                // fokus ke select baru (opsional)
                    const lastSelect = traceBody.querySelector(`select[data-index="${rowIndex-1}"]`);
                    if (lastSelect) lastSelect.focus();
                }
            });
        }

    // ========== HAPUS ROW (DELEGATED) ==========
        document.addEventListener("click", e => {
            if (e.target && e.target.classList.contains("removeRow")) {
                const tr = e.target.closest("tr");
                if (tr) {
                    tr.remove();
                // recalc total
                    hitungTotal();
                // optional: reindexing input names is possible but not required for simple forms
                }
            }
        });

    // ========== AUTO ISI NO DOKUMEN (DELEGATED) ==========
    // NOTE: data-no-dokumen -> dataset.noDokumen
        document.addEventListener('change', e => {
            if (e.target && e.target.classList.contains('laporan-select')) {
                const opt = e.target.selectedOptions && e.target.selectedOptions[0];
                const no = opt ? (opt.dataset.noDokumen ?? '') : '';
                const idx = e.target.dataset.index;

            // cari input yang sesuai, aman jika tidak ada
                const targetInput = document.querySelector(`input[name="kelengkapan_form[${idx}][no_dokumen]"]`);
                if (targetInput) {
                    targetInput.value = no;
                }
            }
        });

    // ========== HITUNG TOTAL WAKTU ==========
        function hitungTotal() {
            let total = 0;

            document.querySelectorAll('.waktu-telusur').forEach(i => {
                if (i.value) {
                // pastikan format HH:MM
                    const parts = i.value.split(':');
                    if (parts.length === 2) {
                        const h = parseInt(parts[0]) || 0;
                        const m = parseInt(parts[1]) || 0;
                        total += (h * 60) + m;
                    }
                }
            });

            let jam = Math.floor(total / 60);
            let menit = total % 60;

            const totalEl = document.getElementById('total_waktu');
            if (totalEl) {
                totalEl.value = `${jam} jam ${menit} menit`;
            }
        }

    // hitung saat halaman dibuka
        hitungTotal();

}); // end DOMContentLoaded
</script>


@endsection
