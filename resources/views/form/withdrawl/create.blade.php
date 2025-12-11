@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4">
                <i class="bi bi-plus-circle"></i> Form Input Laporan Withdrawl
            </h4>

            <form id="withdrawlForm" method="POST" action="{{ route('withdrawl.store') }}">
                @csrf

                {{-- ===================== DATA WITHDRAWL ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Withdrawl</strong>
                    </div>

                    <div class="card-body">

                        {{-- Tanggal + No Withdrawl --}}
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label fw-bold">Tanggal</label>
                            <div class="col-md-3">
                                <input type="date" name="date" id="dateInput"
                                class="form-control @error('date') is-invalid @enderror"
                                value="{{ old('date', now()->format('Y-m-d')) }}" required>
                                @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <label class="col-md-3 col-form-label fw-bold">No. Withdrawl</label>
                            <div class="col-md-3">
                                <input type="text" name="no_withdrawl"
                                class="form-control @error('no_withdrawl') is-invalid @enderror"
                                value="{{ old('no_withdrawl') }}">
                                @error('no_withdrawl') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Nama Produk --}}
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label fw-bold">Nama Produk</label>
                            <div class="col-md-9">
                                <select name="nama_produk"
                                class="form-control selectpicker @error('nama_produk') is-invalid @enderror"
                                data-live-search="true" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($produks as $produk)
                                <option value="{{ $produk->nama_produk }}"
                                    {{ old('nama_produk') == $produk->nama_produk ? 'selected' : '' }}>
                                    {{ $produk->nama_produk }}
                                </option>
                                @endforeach
                            </select>
                            @error('nama_produk') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    {{-- Kode Produksi + Exp Date --}}
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label fw-bold">Kode Produksi</label>
                        <div class="col-md-3">
                            <input type="text" name="kode_produksi" id="kode_produksi"
                            maxlength="10" class="form-control" value="{{ old('kode_produksi') }}" required>
                            <small id="kodeError" class="text-danger"></small>
                        </div>

                        <label class="col-md-3 col-form-label fw-bold">Tanggal Kadaluarsa</label>
                        <div class="col-md-3">
                            <input type="date" name="exp_date" id="exp_date"
                            class="form-control" value="{{ old('exp_date') }}">
                            <small class="text-muted">Otomatis +7 bulan</small>
                        </div>
                    </div>

                    {{-- Jumlah Produksi --}}
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label fw-bold">Jumlah Produksi</label>
                        <div class="col-md-3">
                            <input type="number" name="jumlah_produksi"
                            class="form-control" value="{{ old('jumlah_produksi') }}">
                        </div>
                    </div>

                    {{-- Tanggal Edar + Jumlah Edar --}}
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label fw-bold">Tanggal Batas Edar</label>
                        <div class="col-md-3">
                            <input type="date" name="tanggal_edar"
                            class="form-control" value="{{ old('tanggal_edar') }}">
                        </div>

                        <label class="col-md-3 col-form-label fw-bold">Jumlah Edar</label>
                        <div class="col-md-3">
                            <input type="number" name="jumlah_edar"
                            class="form-control" value="{{ old('jumlah_edar') }}">
                        </div>
                    </div>

                    {{-- Tanggal Tarik + Jumlah Tarik --}}
                    <div class="row mb-3">
                        <label class="col-md-3 col-form-label fw-bold">Tanggal Akhir Penarikan</label>
                        <div class="col-md-3">
                            <input type="date" name="tanggal_tarik"
                            class="form-control" value="{{ old('tanggal_tarik') }}">
                        </div>

                        <label class="col-md-3 col-form-label fw-bold">Jumlah Tarik</label>
                        <div class="col-md-3">
                            <input type="number" name="jumlah_tarik"
                            class="form-control" value="{{ old('jumlah_tarik') }}">
                        </div>
                    </div>

                </div>
            </div>

            {{-- ===================== DATA RINCIAN ===================== --}}
            <div class="card mb-4">
                <div class="card-header bg-warning text-white d-flex justify-content-between">
                    <strong>Data Rincian</strong>
                    <button type="button" id="addRow" class="btn btn-light btn-sm text-primary fw-bold">
                        + Tambah Rincian
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Distributor</th>
                                <th>Alamat</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="rincianBody">

                            {{-- BARIS PERTAMA DEFAULT --}}
                            <tr>
                                <td>
                                    <select name="rincian[0][nama_supplier]"
                                    class="form-control form-control-sm supplierSelect"
                                    data-row="0" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $sup)
                                    <option value="{{ $sup->nama_supplier }}" data-alamat="{{ $sup->alamat }}">
                                        {{ $sup->nama_supplier }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="text" name="rincian[0][alamat]" id="alamat_0"
                                class="form-control form-control-sm">
                            </td>

                            <td>
                                <input type="number" name="rincian[0][jumlah]"
                                class="form-control form-control-sm">
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan
            </button>

            <a href="{{ route('withdrawl.index') }}" class="btn btn-secondary">
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
    // DATA SUPPLIER UNTUK JS
    const suppliers = @json($suppliers);

    // ================== AUTO HITUNG EXP DATE ==================
    const kodeInput = document.getElementById('kode_produksi');
    const expDateInput = document.getElementById('exp_date');
    const kodeError = document.getElementById('kodeError');

    kodeInput.addEventListener('input', function () {
        let value = this.value.toUpperCase().replace(/\s+/g, '');
        this.value = value;

        kodeError.textContent = '';
        expDateInput.value = '';

        if (value.length !== 10) {
            kodeError.textContent = "Kode produksi harus 10 karakter.";
            return;
        }

        if (!/^[A-Z0-9]+$/.test(value)) {
            kodeError.textContent = "Hanya huruf besar & angka.";
            return;
        }

        const bulanChar = value.charAt(1);
        const hari = parseInt(value.substr(2, 2), 10);

        if (!/^[A-L]$/.test(bulanChar)) {
            kodeError.textContent = "Huruf bulan harus A–L.";
            return;
        }

        if (isNaN(hari) || hari < 1 || hari > 31) {
            kodeError.textContent = "Tanggal harus 01–31.";
            return;
        }

        const bulanMap = {
            A: 0, B: 1, C: 2, D: 3, E: 4, F: 5,
            G: 6, H: 7, I: 8, J: 9, K: 10, L: 11
        };

        let bulan = bulanMap[bulanChar];
        let now = new Date();
        let tahun = now.getFullYear();

        if (bulan < now.getMonth()) tahun++;

        let expDate = new Date(tahun, bulan, hari);
        expDate.setMonth(expDate.getMonth() + 7);

        expDateInput.value = expDate.toISOString().slice(0, 10);
    });

    // ================== TAMBAH RINCIAN ==================
    let rowIndex = 1;

    $("#addRow").click(function () {
        let options = `<option value="">-- Pilih Supplier --</option>`;
        suppliers.forEach(s => {
            options += `<option value="${s.nama_supplier}" data-alamat="${s.alamat}">
                            ${s.nama_supplier}
        </option>`;
    });

        let row = `
            <tr>
                <td>
                    <select name="rincian[${rowIndex}][nama_supplier]"
                        class="form-control form-control-sm supplierSelect"
                        data-row="${rowIndex}">
                        ${options}
                    </select>
                </td>

                <td>
                    <input type="text" name="rincian[${rowIndex}][alamat]"
                        id="alamat_${rowIndex}" class="form-control form-control-sm" readonly>
                </td>

                <td>
                    <input type="number" name="rincian[${rowIndex}][jumlah]"
                        class="form-control form-control-sm">
                </td>

                <td>
                    <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                </td>
            </tr>
        `;

        $("#rincianBody").append(row);
        rowIndex++;
    });

    // ================== AUTO-FILL ALAMAT ==================
    $(document).on("change", ".supplierSelect", function () {
        let row = $(this).data("row");
        let alamat = $(this).find(":selected").data("alamat") || "";
        $("#alamat_" + row).val(alamat);
    });

    // ================== HAPUS ROW ==================
    $(document).on("click", ".removeRow", function () {
        $(this).closest("tr").remove();
    });
</script>

@endsection
