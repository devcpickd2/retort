@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-plus-circle"></i> Form Input Pemeriksaan Organoleptik</h4>

            <form method="POST" action="{{ route('organoleptik.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- ===================== IDENTITAS ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control" value="{{ old('date', $data->date ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="1" {{ old('shift', $data->shift ?? '') == '1' ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ old('shift', $data->shift ?? '') == '2' ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ old('shift', $data->shift ?? '') == '3' ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Produk</label>
                                <select id="nama_produk" name="nama_produk" class="form-control selectpicker" data-live-search="true" title="Ketik nama produk..." required>
                                    @foreach($produks as $produk)
                                    <option value="{{ $produk->nama_produk }}" {{ old('nama_produk', $data->nama_produk ?? '') == $produk->nama_produk ? 'selected' : '' }}>
                                        {{ $produk->nama_produk }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===================== PEMERIKSAAN ===================== --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <strong>Pemeriksaan Sensori</strong>
                        <button type="button" id="addRow" class="btn btn-light btn-sm text-dark">
                            <i class="bi bi-plus-lg"></i> Tambah Pemeriksaan
                        </button>
                    </div>

                    <div class="card-body p-0">
                       <div class="alert alert-warning mt-2 py-3 px-3" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle"></i>
                        <strong> Keterangan Parameter:</strong>
                        <strong> Penampilan, Aroma, Rasa Keseluruhan:</strong>
                        <ul class="mb-2 mt-2">
                            <li>1. Sangat Tidak</li>
                            <li>2. Biasa</li>
                            <li>3. Sangat</li>
                        </ul>
                        <i class="bi bi-info-circle"></i>
                        <strong> Kekenyalan, Manis, Asin, Gurih, Ayam/BBQ/Ikan:</strong>
                        <ul class="mb-2 mt-2">
                            <li>1. Terlalu</li>
                            <li>2. Kurang</li>
                            <li>3. Pas</li>
                        </ul>
                        <strong>Keterangan Hasil Score:</strong>
                        <ul class="mb-0 mt-2">
                            <li>1 – 1.5 : Tidak Release</li>
                            <li>1.6 – 3 : Release</li>
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center align-middle" id="pemeriksaanTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Produksi</th>
                                    <th>Penampilan</th>
                                    <th>Aroma</th>
                                    <th>Kekenyalan</th>
                                    <th>Rasa Asin</th>
                                    <th>Rasa Gurih</th>
                                    <th>Rasa Manis</th>
                                    <th>Rasa Ayam/BBQ/Ikan</th>
                                    <th>Rasa Keseluruhan</th>
                                    <th>Hasil Score</th>
                                    <th>Release/Tidak Release</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="sensoriTable">
                                <tr>
                                    <td>
                                        <input type="text" name="sensori[0][kode_produksi]" class="form-control form-control-sm b kode_produksi" maxlength="10" required>
                                        <small class="kodeError text-danger d-none"></small>
                                    </td>
                                    <td><input type="number" name="sensori[0][penampilan]" class="form-control form-control-sm sensori" min="0" max="3" step="1"></td>
                                    <td><input type="number" name="sensori[0][aroma]" class="form-control form-control-sm sensori" min="0" max="3" step="1"></td>
                                    <td><input type="number" name="sensori[0][kekenyalan]" class="form-control form-control-sm sensori" min="0" max="3" step="1"></td>
                                    <td><input type="number" name="sensori[0][rasa_asin]" class="form-control form-control-sm sensori" min="0" max="3" step="1"></td>
                                    <td><input type="number" name="sensori[0][rasa_gurih]" class="form-control form-control-sm sensori" min="0" max="3" step="1"></td>
                                    <td><input type="number" name="sensori[0][rasa_manis]" class="form-control form-control-sm sensori" min="0" max="3" step="1"></td>
                                    <td><input type="number" name="sensori[0][rasa_daging]" class="form-control form-control-sm sensori" min="0" max="3" step="1"></td>
                                    <td><input type="number" name="sensori[0][rasa_keseluruhan]" class="form-control form-control-sm sensori" min="0" max="3" step="1"></td>
                                    <td><input type="number" step="0.1" name="sensori[0][rata_score]" class="form-control form-control-sm rata_score" readonly></td>
                                    <td><input type="text" name="sensori[0][release]" class="form-control form-control-sm b release" readonly></td>
                                    <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="bi bi-trash"></i></button></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            {{-- ===================== TOMBOL SIMPAN ===================== --}}
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-success w-auto"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('organoleptik.index') }}" class="btn btn-secondary w-auto"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>
</div>

{{-- ===================== SCRIPTS ===================== --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(){
        // Inisialisasi selectpicker setelah DOM siap
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $(function() {
    // ========== Set tanggal & shift otomatis ==========
        const dateInput = $('#dateInput');
        const shiftInput = $('#shiftInput');
        const now = new Date();
        const yyyy = now.getFullYear();
        const mm = String(now.getMonth() + 1).padStart(2, '0');
        const dd = String(now.getDate()).padStart(2, '0');
        const hh = now.getHours();
        dateInput.val(`${yyyy}-${mm}-${dd}`);
        if (hh >= 7 && hh < 15) shiftInput.val('1');
        else if (hh >= 15 && hh < 23) shiftInput.val('2');
        else shiftInput.val('3');

    // ========== Fungsi hitung rata-rata ==========
        function hitungRata(row) {
            const nilai = $(row).find('.sensori').map(function(){ 
                return parseFloat($(this).val()) || 0;
            }).get();
            const isi = nilai.filter(v => v > 0).length;
            if (isi === 0) return;
            const avg = (nilai.reduce((a,b)=>a+b,0) / isi).toFixed(1);
            $(row).find('.rata_score').val(avg);

            const release = $(row).find('.release');
            if (avg >= 1 && avg <= 1.5) {
                release.val('Tidak Release').css({color:'red',fontWeight:'bold'});
            } else if (avg >= 1.6 && avg <= 3) {
                release.val('Release').css({color:'green',fontWeight:'bold'});
            } else {
                release.val('').css({color:'',fontWeight:''});
            }
        }

    // ========== Event input nilai sensori ==========
        $(document).on('input', '.sensori', function(){
            const row = $(this).closest('tr');
            hitungRata(row);
        });

    // ========== Validasi kode produksi ==========
        function validateKode(value) {
            if (!value) return { valid: false, message: "Kode produksi wajib diisi." };
            value = value.toUpperCase().replace(/\s+/g,'');
            if (value.length !== 10) return { valid:false, message: "Kode produksi harus 10 karakter." };
            const format = /^[A-Z0-9]+$/;
            if (!format.test(value)) return { valid:false, message: "Kode produksi hanya boleh huruf besar dan angka." };
            const pattern = /^[A-Z0-9][A-L](0[1-9]|[12][0-9]|3[01])[A-Z0-9]{6}$/;
            if (!pattern.test(value)) return { valid:false, message: "Format: ke-2 A–L, ke-3/4 tanggal 01–31." };
            return { valid:true, message:"✔ Kode produksi valid." };
        }

    // ========== Event input kode produksi ==========
        $(document).on('input', '.kode_produksi', function() {
            const $this = $(this);
            const row = $this.closest('tr');
            const val = $this.val().toUpperCase().replace(/\s+/g,'');
            $this.val(val);

            const result = validateKode(val);
            const $err = row.find('.kodeError');

            if (!result.valid) {
                $err.text(result.message).removeClass('d-none text-success').addClass('text-danger');
                $this.addClass('is-invalid').removeClass('is-valid');
            } else {
                $err.text(result.message).removeClass('d-none text-danger').addClass('text-success');
                $this.addClass('is-valid').removeClass('is-invalid');
            }
        });

    // ========== Tambah baris baru (HANYA SATU EVENT) ==========
        $(document).off('click', '#addRow').on('click', '#addRow', function(){
            const table = $('#pemeriksaanTable tbody');
            const index = table.find('tr').length;
            const clone = table.find('tr:first').clone();

            clone.find('input, small').each(function(){
                const name = $(this).attr('name');
                if (name) {
        // Ambil key kolom seperti "penampilan", "aroma", dst.
                    const key = name.match(/\[([a-zA-Z0-9_]+)\]$/);
                    if (key && key[1]) {
                        $(this).attr('name', `sensori[${index}][${key[1]}]`);
                    }
                }

                if ($(this).is('input')) $(this).val('').removeClass('is-valid is-invalid');
                if ($(this).is('small')) $(this).text('').addClass('d-none').removeClass('text-success text-danger');
            });


            table.append(clone);
        });

    // ========== Hapus baris ==========
        $(document).on('click', '.removeRow', function(){
            if ($('#pemeriksaanTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert('Minimal harus ada satu baris pemeriksaan.');
            }
        });

    // ========== Prevent submit jika ada kode tidak valid ==========
        $('form').on('submit', function(e) {
            let firstInvalid = null;
            $('#pemeriksaanTable tbody tr').each(function() {
                const $kode = $(this).find('.kode_produksi');
                const res = validateKode(($kode.val() || '').toUpperCase().replace(/\s+/g,''));
                const $err = $(this).find('.kodeError');
                if (!res.valid) {
                    $err.text(res.message).removeClass('d-none text-success').addClass('text-danger');
                    $kode.addClass('is-invalid').removeClass('is-valid');
                    if (!firstInvalid) firstInvalid = $kode;
                } else {
                    $err.text(res.message).removeClass('d-none text-danger').addClass('text-success');
                    $kode.addClass('is-valid').removeClass('is-invalid');
                }
            });

            if (firstInvalid) {
                e.preventDefault();
                firstInvalid.focus();
                alert('Terdapat kode produksi tidak valid. Periksa kembali baris yang berwarna merah.');
            }
        });

    });
</script>

<style>
    .table th, .table td { padding: 0.5rem; vertical-align: middle; font-size: 0.9rem; }
    .form-control-sm { min-width: 90px; font-size: 0.9rem; }
    .b { min-width: 150px; font-size: 0.9rem; }
    .table-bordered th, .table-bordered td { text-align: center; }
</style>
@endsection
