@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4"><i class="bi bi-plus-circle"></i> Form Input Pemeriksaan Mincing - Emulsifying - Aging</h4>

            <form method="POST" action="{{ route('mincing.store') }}">
                @csrf

                {{-- ===================== Identitas ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Data Mincing - Emulsifying - Aging</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date" class="form-control"
                                value="{{ old('date', $data->date ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift" class="form-control" required>
                                    <option value="">-- Pilih Shift --</option>
                                    <option value="1">Shift 1</option>
                                    <option value="2">Shift 2</option>
                                    <option value="3">Shift 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <label class="form-label">Nama Produk</label>
                            <div class="{{ $errors->has('nama_produk') ? 'has-error' : '' }}">
                                <select id="nama_produk"
                                name="nama_produk"
                                class="form-control selectpicker"
                                data-live-search="true"
                                title="Ketik nama produk..."
                                required>
                                @foreach($produks as $produk) 
                                <option value="{{ $produk->nama_produk }}"
                                    {{ old('nama_produk', $data->nama_produk ?? '') == $produk->nama_produk ? 'selected' : '' }}>
                                    {{ $produk->nama_produk }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Pesan error manual di bawah dropdown --}}
                        @if ($errors->has('nama_produk'))
                        <div class="invalid-feedback d-block mt-1">{{ $errors->first('nama_produk') }}</div>
                        @endif
                    </div>


                </div>

            </div>
        </div>

        {{-- ===================== Pemeriksaan ===================== --}}
        <div class="card mb-4">
            <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                <strong>Mincing - Emulsifying - Aging</strong>
                <button type="button" id="addmincingColumn" class="btn btn-primary btn-sm">
                    + Tambah Pemeriksaan
                </button>
            </div>
            <div class="card-body table-responsive" style="overflow-x:auto;">
                <div class="alert alert-danger mt-2 py-2 px-3" style="font-size: 0.9rem;">
                    <i class="bi bi-info-circle"></i>
                    <strong>Catatan:</strong>  
                    <i class="bi bi-check-circle text-success"></i> Checkbox apabila hasil <u>Oke</u>.  
                    Kosongkan Checkbox apabila hasil <u>Tidak Oke</u>.
                </div>

                <table class="table table-bordered table-sm text-center align-middle" id="mincingTable">
                    <thead class="table-light">
                        <tr id="headerRow">
                            <th style="min-width: 220px; text-align: left;">Parameter</th>
                            <th colspan="5">Pemeriksaan 1</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Kode Produksi --}}
                        <tr data-template="kode_produksi">
                            <td class="text-left">Kode Produksi</td>
                            <td colspan="5">
                                <input type="text"
                                name="proses[0][kode_produksi]"
                                class="form-control form-control-sm @error('proses.0.kode_produksi') is-invalid @enderror"
                                value="{{ old('proses.0.kode_produksi') }}">
                                @error('proses.0.kode_produksi')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        {{-- Preparation --}}
                        <tr data-template="preparation">
                            <td class="text-left">Preparation</td>
                            <td colspan="2"><input type="time" name="proses[0][waktu_mulai_prep]" class="form-control form-control-sm"></td>
                            <td>-</td>
                            <td colspan="2"><input type="time" name="proses[0][waktu_selesai_prep]" class="form-control form-control-sm"></td>
                        </tr>

                        {{-- Parameter Header --}}
                        <tr class="section-header" data-template="parameter_header">
                            <td class="text-left fw-bold bg-light">Parameter</td>
                            <td class="text-center fw-bold bg-light">Kode</td>
                            <td class="text-center fw-bold bg-light">(°C)</td>
                            <td class="text-center fw-bold bg-light">*pH</td>
                            <td class="text-center fw-bold bg-light">Kg</td>
                            <td class="text-center fw-bold bg-light">Sens</td>
                        </tr>

                        <tr class="section-header" data-template="bahan_header">
                            <td colspan="6" class="text-left fw-bold bg-light">Bahan Baku dan Bahan Tambahan</td>
                        </tr>
                        @for($i = 0; $i < 17; $i++)
                        <tr data-template="bahan">
                            {{-- Nama bahan masuk juga ke dalam proses --}}
                            @for($index = 0; $index < 1; $index++)
                            <td><input type="text" name="proses[{{ $index }}][nama_bahan][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="proses[{{ $index }}][kode_bahan][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="proses[{{ $index }}][suhu_bahan][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="proses[{{ $index }}][kadar_bahan][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="proses[{{ $index }}][berat_bahan][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td><input type="checkbox" name="proses[{{ $index }}][sens_bahan][{{ $i }}]" value="Oke" class="big-checkbox"></td>
                            @endfor
                        </tr>
                        @endfor

                        <tr class="section-header" data-template="premix_header">
                            <td class="text-left fw-bold bg-light">Premix</td>
                            <td class="text-center fw-bold bg-light" colspan="2">Kode</td>
                            <td class="text-center fw-bold bg-light" colspan="2">Kg</td>
                            <td class="text-center fw-bold bg-light">Sens</td>
                        </tr>
                        @for($i = 0; $i < 3; $i++)
                        <tr data-template="premix">
                            {{-- Nama premix masuk ke dalam proses --}}
                            @for($index = 0; $index < 1; $index++)
                            <td><input type="text" name="proses[{{ $index }}][nama_premix][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="proses[{{ $index }}][kode_premix1][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td><input type="text" name="proses[{{ $index }}][kode_premix2][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td colspan="2"><input type="text" name="proses[{{ $index }}][berat_premix][{{ $i }}]" class="form-control form-control-sm"></td>
                            <td><input type="checkbox" name="proses[{{ $index }}][sens_premix][{{ $i }}]" value="Oke" class="big-checkbox"></td>
                            @endfor
                        </tr>
                        @endfor

                        <!-- SBL -->
                        <tr data-template="suhu_daging">
                            <td class="text-left">Suhu (Sebelum Grinding)</td>
                            <td>
                                <select name="proses[0][jenis_daging]" class="form-control form-control-sm">
                                    <option value="">-- Pilih Jenis --</option>
                                    <option value="BEEF">BEEF</option>
                                    <option value="SBB">SBB</option>
                                    <option value="SBL">SBL</option>
                                    <option value="MDM">MDM</option>
                                    <option value="CCM">CCM</option>
                                </select>
                            </td>
                            <td colspan="4"><input type="text" name="proses[0][suhu_daging]" class="form-control form-control-sm"></td>
                        </tr>

                        {{-- Waktu & Suhu --}}
                        <tr data-template="waktu_suhu">
                            <td class="text-left">Waktu Mixing Premix (Menit)</td>
                            <td colspan="2"><input type="time" name="proses[0][waktu_premix_mulai]" class="form-control form-control-sm"></td>
                            <td>-</td>
                            <td colspan="2"><input type="time" name="proses[0][waktu_premix_selesai]" class="form-control form-control-sm"></td>
                        </tr>
                        <tr data-template="waktu_suhu">
                            <td class="text-left">Waktu Bowl Cutter (Menit)</td>
                            <td colspan="2"><input type="time" name="proses[0][waktu_bowl_mulai]" class="form-control form-control-sm"></td>
                            <td>-</td>
                            <td colspan="2"><input type="time" name="proses[0][waktu_bowl_selesai]" class="form-control form-control-sm"></td>
                        </tr>
                        <tr data-template="waktu_suhu">
                            <td class="text-left">Waktu Aging Emulsi</td>
                            <td colspan="2"><input type="time" name="proses[0][waktu_aging_mulai]" class="form-control form-control-sm"></td>
                            <td>-</td>
                            <td colspan="2"><input type="time" name="proses[0][waktu_aging_selesai]" class="form-control form-control-sm"></td>
                        </tr>
                        <tr data-template="waktu_suhu">
                            <td class="text-left">Suhu Akhir Emulsi Gel (Std <5°C)</td>
                                <td colspan="5"><input type="text" name="proses[0][suhu_akhir_emulsi_gel]" class="form-control form-control-sm"></td>
                            </tr>
                            <tr data-template="waktu_suhu">
                                <td class="text-left">Waktu Mixing (Menit)</td>
                                <td colspan="5"><input type="number" name="proses[0][waktu_mixing]" class="form-control form-control-sm"></td>
                            </tr>
                            <tr data-template="waktu_suhu">
                                <td class="text-left">Suhu Akhir Mixing (Std 2-5°C)</td>
                                <td colspan="5"><input type="text" name="proses[0][suhu_akhir_mixing]" class="form-control form-control-sm"></td>
                            </tr>
                            <tr data-template="waktu_suhu">
                                <td class="text-left">Suhu Akhir Emulsifying (Std 14+_2°C)</td>
                                <td colspan="5"><input type="text" name="proses[0][suhu_akhir_emulsifying]" class="form-control form-control-sm"></td>
                            </tr>

                            {{-- Aksi --}}
                            <tr data-template="aksi">
                                <td class="text-left">Aksi</td>
                                <td colspan="5"><button type="button" class="btn btn-danger btn-sm removeColumn">Hapus Pemeriksaan 1</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ===================== Catatan ===================== --}}
            <div class="card mb-4">
                <div class="card-header bg-light"><strong>Catatan</strong></div>
                <div class="card-body">
                    <textarea name="catatan" class="form-control" rows="3"
                    placeholder="Tambahkan catatan bila ada">{{ old('catatan', $data->catatan ?? '') }}</textarea>
                </div>
            </div>

            {{-- ===================== Tombol Simpan ===================== --}}
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-success w-auto"><i class="bi bi-save"></i> Simpan</button>
                <a href="{{ route('mincing.index') }}" class="btn btn-secondary w-auto"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>

        </form>
    </div>
</div>
</div>

{{-- ===================== Scripts ===================== --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
        @if ($errors->has('nama_produk'))
    // Tunggu dropdown digenerate baru kasih border merah
        setTimeout(function() {
            $('select[name="nama_produk"]').closest('.bootstrap-select').find('button.dropdown-toggle').addClass('is-invalid');
        }, 200);
        @endif

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("dateInput");
        const shiftInput = document.getElementById("shiftInput");

    // Ambil waktu sekarang
        let now = new Date();
        let yyyy = now.getFullYear();
        let mm = String(now.getMonth() + 1).padStart(2, '0');
        let dd = String(now.getDate()).padStart(2, '0');
        let hh = String(now.getHours()).padStart(2, '0');
        let min = String(now.getMinutes()).padStart(2, '0');

    // Set value tanggal dan jam
        dateInput.value = `${yyyy}-${mm}-${dd}`;

    // Tentukan shift berdasarkan jam
        let hour = parseInt(hh);
        if (hour >= 7 && hour < 15) {
            shiftInput.value = "1";
        } else if (hour >= 15 && hour < 23) {
            shiftInput.value = "2";
        } else {
            shiftInput.value = "3"; 
        }

    });
</script>
<script>
    $(document).on('input', 'input[name^="proses"][name$="[kode_produksi]"]', function () {
    let val = $(this).val().toUpperCase().replace(/\s+/g, ''); // huruf besar & hapus spasi

    // Batasi hanya huruf dan angka
    val = val.replace(/[^A-Z0-9]/g, '');

    // Jika lebih dari 10 karakter, potong
    if (val.length > 10) {
        val = val.substring(0, 10);
    }

    // Masukkan kembali nilai yang sudah diformat
    $(this).val(val);

    // Validasi: panjang wajib 10 karakter
    if (val.length !== 10) {
        $(this).css('border', '2px solid red');
        $(this).attr('title', 'Kode produksi harus 10 karakter (huruf besar, tanpa spasi)');
    } else {
        $(this).css('border', '');
        $(this).removeAttr('title');
    }
});
</script>

<script>
    $(document).ready(function () {
    let columnCount = 1; // Pemeriksaan pertama sudah ada

    $('#addmincingColumn').click(function () {
        const table = $('#mincingTable');
        const idx = columnCount;

        // 1️⃣ Tambah header baru
        table.find('#headerRow').append(`
            <th colspan="5" class="text-center bg-light" data-index="${idx}">Pemeriksaan ${idx + 1}</th>
        `);

        // 2️⃣ Tambah Kode Produksi
        table.find('tr[data-template="kode_produksi"]').append(`
            <td colspan="5" data-index="${idx}">
                <input type="text" name="proses[${idx}][kode_produksi]" class="form-control form-control-sm">
            </td>
        `);

// 3️⃣ Preparation
        table.find('tr[data-template="preparation"]').append(`
    <td colspan="2" data-index="${idx}">
        <input type="time" name="proses[${idx}][waktu_mulai_prep]" class="form-control form-control-sm">
    </td>
    <td class="text-center" data-index="${idx}">-</td>
    <td colspan="2" data-index="${idx}">
        <input type="time" name="proses[${idx}][waktu_selesai_prep]" class="form-control form-control-sm">
    </td>
        `);

        table.find('tr[data-template="parameter_header"]').append(`
    <td class="text-center fw-bold bg-light" data-index="${idx}">Kode</td>
    <td class="text-center fw-bold bg-light" data-index="${idx}">(°C)</td>
    <td class="text-center fw-bold bg-light" data-index="${idx}">*pH</td>
    <td class="text-center fw-bold bg-light" data-index="${idx}">Kg</td>
    <td class="text-center fw-bold bg-light" data-index="${idx}">Sens</td>
        `);

        // 4️⃣ Bahan Baku & Tambahan (17 baris)
        for (let i = 0; i < 17; i++) {
            table.find('tr[data-template="bahan"]:eq(' + i + ')').append(`
                <td data-index="${idx}"><input type="text" name="proses[${idx}][kode_bahan][${i}]" class="form-control form-control-sm"></td>
                <td data-index="${idx}"><input type="text" name="proses[${idx}][suhu_bahan][${i}]" class="form-control form-control-sm"></td>
                <td data-index="${idx}"><input type="text" name="proses[${idx}][kadar_bahan][${i}]" class="form-control form-control-sm"></td>
                <td data-index="${idx}"><input type="text" name="proses[${idx}][berat_bahan][${i}]" class="form-control form-control-sm"></td>
                <td data-index="${idx}"><input type="checkbox" name="proses[${idx}][sens_bahan][${i}]" value="Oke" class="big-checkbox"></td>
            `);
        }
        table.find('tr[data-template="premix_header"]').append(`
            <td class="text-center fw-bold bg-light" colspan="2" data-index="${idx}">Kode</td>
            <td class="text-center fw-bold bg-light" colspan="2" data-index="${idx}">Kg</td>
            <td class="text-center fw-bold bg-light" data-index="${idx}">Sens</td>
        `);
        // 5️⃣ Premix (3 baris)
        for (let i = 0; i < 3; i++) {
            table.find('tr[data-template="premix"]:eq(' + i + ')').append(`
                <td data-index="${idx}"><input type="text" name="proses[${idx}][kode_premix1][${i}]" class="form-control form-control-sm"></td>
                <td data-index="${idx}"><input type="text" name="proses[${idx}][kode_premix2][${i}]" class="form-control form-control-sm"></td>
                <td colspan="2" data-index="${idx}"><input type="text" name="proses[${idx}][berat_premix][${i}]" class="form-control form-control-sm"></td>
                <td data-index="${idx}"><input type="checkbox" name="proses[${idx}][sens_premix][${i}]" value="Oke" class="big-checkbox"></td>
            `);
        }

        // 6️⃣ Suhu Daging
        table.find('tr[data-template="suhu_daging"]').append(`
            <td data-index="${idx}">
                <select name="proses[${idx}][jenis_daging]" class="form-control form-control-sm">
                    <option value="">-- Pilih Jenis --</option>
                    <option value="BEEF">BEEF</option>
                    <option value="SBB">SBB</option>
                    <option value="SBL">SBL</option>
                    <option value="MDM">MDM</option>
                    <option value="CCM">CCM</option>
                </select>
            </td>
            <td colspan="4" data-index="${idx}">
                <input type="text" name="proses[${idx}][suhu_daging]" class="form-control form-control-sm">
            </td>
        `);

        table.find('tr[data-template="waktu_suhu"]').each(function () {
            const label = $(this).find('td:first').text().trim();
            let html = '';

            if (label.includes('Waktu Mixing Premix')) {
                html = `
            <td colspan="2" data-index="${idx}">
                <input type="time" name="proses[${idx}][waktu_premix_mulai]" class="form-control form-control-sm">
            </td>
            <td class="text-center" data-index="${idx}">-</td>
            <td colspan="2" data-index="${idx}">
                <input type="time" name="proses[${idx}][waktu_premix_selesai]" class="form-control form-control-sm">
                </td>`;
            } 
            else if (label.includes('Waktu Bowl Cutter')) {
                html = `
            <td colspan="2" data-index="${idx}">
                <input type="time" name="proses[${idx}][waktu_bowl_mulai]" class="form-control form-control-sm">
            </td>
            <td class="text-center" data-index="${idx}">-</td>
            <td colspan="2" data-index="${idx}">
                <input type="time" name="proses[${idx}][waktu_bowl_selesai]" class="form-control form-control-sm">
                </td>`;
            } 
            else if (label.includes('Waktu Aging Emulsi')) {
                html = `
            <td colspan="2" data-index="${idx}">
                <input type="time" name="proses[${idx}][waktu_aging_mulai]" class="form-control form-control-sm">
            </td>
            <td class="text-center" data-index="${idx}">-</td>
            <td colspan="2" data-index="${idx}">
                <input type="time" name="proses[${idx}][waktu_aging_selesai]" class="form-control form-control-sm">
                </td>`;
            } 
            else if (label.includes('Suhu Akhir Emulsi Gel')) {
                html = `
            <td colspan="5" data-index="${idx}">
                <input type="text" name="proses[${idx}][suhu_akhir_emulsi_gel]" class="form-control form-control-sm">
                </td>`;
            } 
            else if (label.includes('Waktu Mixing')) {
                html = `
            <td colspan="5" data-index="${idx}">
                <input type="number" name="proses[${idx}][waktu_mixing]" class="form-control form-control-sm">
                </td>`;
            } 
            else if (label.includes('Suhu Akhir Mixing')) {
                html = `
            <td colspan="5" data-index="${idx}">
                <input type="text" name="proses[${idx}][suhu_akhir_mixing]" class="form-control form-control-sm">
                </td>`;
            } 
            else if (label.includes('Suhu Akhir Emulsifying')) {
                html = `
            <td colspan="5" data-index="${idx}">
                <input type="text" name="proses[${idx}][suhu_akhir_emulsifying]" class="form-control form-control-sm">
                </td>`;
            }

            $(this).append(html);
        });

        // 8️⃣ Aksi
        table.find('tr[data-template="aksi"]').append(`
            <td colspan="5" class="text-center aksi-block" data-index="${idx}">
                <button type="button" class="btn btn-danger btn-sm removeColumnBlock" data-index="${idx}">Hapus Pemeriksaan ${idx + 1}</button>
            </td>
        `);

        columnCount++;
    });

    // Hapus seluruh blok pemeriksaan
$(document).on('click', '.removeColumnBlock', function () {
    const idx = parseInt($(this).data('index'));
    const table = $('#mincingTable');

        // Hapus header & semua kolom dari pemeriksaan ke-idx
    table.find(`#headerRow th[data-index="${idx}"]`).remove();
    table.find(`td[data-index="${idx}"]`).remove();

    columnCount--;

        // Update index untuk pemeriksaan di belakangnya
    table.find('th[data-index], td[data-index]').each(function () {
        const currentIndex = parseInt($(this).attr('data-index'));
        if (currentIndex > idx) {
            const newIndex = currentIndex - 1;
            $(this).attr('data-index', newIndex);

            const input = $(this).find('input, select');
            input.each(function () {
                const oldName = $(this).attr('name');
                if (oldName) {
                    const newName = oldName.replace(/\[\d+\]/, `[${newIndex}]`);
                    $(this).attr('name', newName);
                }
            });
        }
    });

        // Update label header dan tombol hapus
    table.find('#headerRow th[data-index]').each(function () {
        const newIndex = parseInt($(this).attr('data-index'));
        $(this).text(`Pemeriksaan ${newIndex + 1}`);
    });
    table.find('.aksi-block').each(function () {
        const newIndex = parseInt($(this).attr('data-index'));
        $(this).find('button')
        .attr('data-index', newIndex)
        .text(`Hapus Pemeriksaan ${newIndex + 1}`);
    });
});
});

</script>

<style>
    .table-bordered th, .table-bordered td { text-align:center; vertical-align: middle; }
    .form-control-sm { min-width:120px; }
    .bootstrap-select.is-invalid .dropdown-toggle {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25) !important;
    }


</style>
@endsection
