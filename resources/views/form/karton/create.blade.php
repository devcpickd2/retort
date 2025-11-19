@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-plus-circle"></i> Form Input Kontrol Labelisasi Karton
            </h4>

            <form id="samplingForm" action="{{ route('karton.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ===================== IDENTITAS DATA ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Data Packing</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="date" id="dateInput" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <select name="nama_produk" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produks as $produk)
                                    <option value="{{ $produk->nama_produk }}">{{ $produk->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kode Produksi</label>
                                <input type="text" name="kode_produksi" id="kode_produksi" class="form-control" maxlength="10" required>
                                <small id="kodeError" class="text-danger d-none"></small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===================== ITEM SORTIR ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <strong>Pemeriksaan</strong>
                    </div>
                    <div class="card-body">

                       <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Waktu Proses</label>
                            <div class="input-group">
                                <input type="time" id="waktu_mulai" name="waktu_mulai" class="form-control">
                                <span class="input-group-text"> -  </span>
                                <input type="time" id="waktu_selesai" name="waktu_selesai" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tgl Kedatangan</label>
                            <input type="date" name="tgl_kedatangan" id="tgl_kedatangan" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jumlah / Tambahan</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Supplier</label>
                            <select id="nama_supplier" name="nama_supplier" class="form-control selectpicker" data-live-search="true" required>
                                <option value="">-- Pilih Supplier --</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->nama_supplier }}">{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">No. Lot Karton</label>
                            <input type="text" name="no_lot" id="no_lot" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kode Produksi (Karton)</label>
                            <input type="file" id="kode_karton" name="kode_karton" class="form-control" accept="image/*" required>
                            <small id="kode-karton-error" class="text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white">
                    <strong>Operator - KR</strong>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Operator</label>
                            <select id="nama_operator" name="nama_operator" class="form-control selectpicker"  data-live-search="true" required>
                                <option value="">-- Pilih Operator --</option>
                                @foreach($operators as $operator)
                                <option value="{{ $operator->nama_karyawan }}">{{ $operator->nama_karyawan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama KR</label>
                            <select id="nama_koordinator" name="nama_koordinator" class="form-control selectpicker"  data-live-search="true" required>
                                <option value="">-- Pilih Koordinator --</option>
                                @foreach($koordinators as $koordinator)
                                <option value="{{ $koordinator->nama_karyawan }}">{{ $koordinator->nama_karyawan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===================== CATATAN ===================== --}}
            <div class="card mb-4">
                <div class="card-header bg-light"><strong>Keterangan</strong></div>
                <div class="card-body">
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan bila ada">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            {{-- ===================== TOMBOL ===================== --}}
            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('karton.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
</div>

{{-- ===================== SCRIPT ===================== --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $(document).ready(function() {
        const kodeInput = document.getElementById('kode_produksi');
        const kodeError = document.getElementById('kodeError');
        const form = document.getElementById('samplingForm');
        const fileInput = document.getElementById('kode_karton');
        const fileError = document.getElementById('kode-karton-error');
    const maxFileSize = 2 * 1024 * 1024; // 2MB

    // ============ VALIDASI FILE (langsung muncul di bawah kolom) ============
    fileInput.addEventListener('change', function() {
        fileError.textContent = "";
        const file = fileInput.files[0];
        if (file && file.size > maxFileSize) {
            fileError.textContent = "Ukuran file maksimal 2MB.";
            fileInput.value = "";
        }
    });

    // ============ VALIDASI KODE PRODUKSI ============
    kodeInput.addEventListener('input', function() {
        validateKode();
    });

    form.addEventListener('submit', function(e) {
        // validasi kode produksi
        if (!validateKode()) {
            e.preventDefault();
            kodeInput.focus();
            return;
        }

        // validasi file upload
        const file = fileInput.files[0];
        fileError.textContent = "";

        if (!file) {
            e.preventDefault();
            fileError.textContent = "File wajib diupload.";
            return;
        }

        if (file.size > maxFileSize) {
            e.preventDefault();
            fileError.textContent = "Ukuran file maksimal 2MB.";
            fileInput.value = "";
            return;
        }
    });

    function validateKode() {
        let value = kodeInput.value.toUpperCase().replace(/\s+/g, '');
        kodeInput.value = value;
        kodeError.textContent = '';
        kodeError.classList.add('d-none');

        if (value.length !== 10) {
            kodeError.textContent = "Kode produksi harus terdiri dari 10 karakter.";
            kodeError.classList.remove('d-none');
            return false;
        }

        const format = /^[A-Z0-9]+$/;
        if (!format.test(value)) {
            kodeError.textContent = "Kode produksi hanya boleh huruf besar dan angka.";
            kodeError.classList.remove('d-none');
            return false;
        }

        const bulanChar = value.charAt(1);
        const validBulan = /^[A-L]$/;
        if (!validBulan.test(bulanChar)) {
            kodeError.textContent = "Karakter ke-2 harus huruf bulan (A–L).";
            kodeError.classList.remove('d-none');
            return false;
        }

        const hariStr = value.substr(2, 2);
        const hari = parseInt(hariStr, 10);
        if (isNaN(hari) || hari < 1 || hari > 31) {
            kodeError.textContent = "Karakter ke-3 dan ke-4 harus tanggal valid (01–31).";
            kodeError.classList.remove('d-none');
            return false;
        }

        return true;
    }

    // ============ OTOMATIS TANGGAL & SHIFT ============
    const dateInput = document.getElementById("dateInput");

    let now = new Date();
    let yyyy = now.getFullYear();
    let mm = String(now.getMonth() + 1).padStart(2, '0');
    let dd = String(now.getDate()).padStart(2, '0');
    let hh = now.getHours();

    dateInput.value = `${yyyy}-${mm}-${dd}`;
});
</script>


@endsection
