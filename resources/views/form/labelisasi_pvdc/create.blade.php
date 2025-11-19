@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-plus-circle"></i> Form Input Kontrol Labelisasi PVDC
            </h4>

            <form id="pvdcForm" enctype="multipart/form-data">
                @csrf

                {{-- ===================== IDENTITAS ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Data PVDC</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="date" id="dateInput" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select name="shift" id="shiftInput" class="form-control" required>
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
                                <select name="nama_produk" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach($produks as $produk)
                                    <option value="{{ $produk->nama_produk }}">{{ $produk->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nama Operator</label>
                                <select id="nama_operator" name="nama_operator" class="form-control selectpicker"  data-live-search="true" required>
                                    <option value="">-- Pilih Operator --</option>
                                    @foreach($operators as $operator)
                                    <option value="{{ $operator->nama_karyawan }}">{{ $operator->nama_karyawan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===================== DATA PVDC ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                        <strong>Data PVDC</strong>
                        <button type="button" id="addRow" class="btn btn-sm btn-light text-primary fw-bold">
                            + Tambah Mesin
                        </button>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered text-center align-middle" id="pvdcTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Mesin</th>
                                    <th>Kode Batch</th>
                                    <th>Bukti Kode (Upload Gambar)</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="pvdcBody">
                                <tr>
                                    <td>
                                        <select name="data_pvdc[0][mesin]" class="form-control form-control-sm" required>
                                            <option value="">-- Pilih Mesin --</option>
                                            @foreach($mesins as $mesin)
                                            <option value="{{ $mesin->nama_mesin }}">{{ $mesin->nama_mesin }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="data_pvdc[0][kode_batch]" class="form-control form-control-sm" required>
                                    </td>
                                    <td>
                                        <input type="file" name="data_pvdc[0][kode_produksi]" class="form-control form-control-sm" accept="image/*" required>
                                        <div class="preview mt-2"></div>
                                    </td>
                                    <td>
                                        <input type="text" name="data_pvdc[0][keterangan]" class="form-control form-control-sm">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm saveRow">Simpan</button>
                                        <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- ===================== TOMBOL ===================== --}}
                <div class="d-flex justify-content-between mt-3">
                    <button type="button" id="saveBtn" class="btn btn-success">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('labelisasi_pvdc.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>

            <hr>
            <div id="resultArea"></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("dateInput");
        const shiftInput = document.getElementById("shiftInput");

        let now = new Date();
        let yyyy = now.getFullYear();
        let mm = String(now.getMonth() + 1).padStart(2, '0');
        let dd = String(now.getDate()).padStart(2, '0');
        let hh = String(now.getHours()).padStart(2, '0');

        dateInput.value = `${yyyy}-${mm}-${dd}`;

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
    $(document).ready(function(){
    // =================== VALIDASI KODE BATCH ===================
        function validateKodeBatch(input) {
            let value = input.val().toUpperCase().replace(/\s+/g, '');
            input.val(value);

        // Hapus notifikasi lama
            input.next(".invalid-feedback").remove();
            input.removeClass("is-invalid");

        // Cek panjang
            if (value.length !== 10) {
                showError(input, "Kode produksi harus terdiri dari 10 karakter.");
                return false;
            }

        // Regex validasi format umum (huruf + angka)
            const format = /^[A-Z0-9]+$/;
            if (!format.test(value)) {
                showError(input, "Kode produksi hanya boleh huruf besar dan angka.");
                return false;
            }

        // Cek awalan
            // if (!value.startsWith("P")) {
            //     showError(input, "Kode produksi harus dimulai dengan huruf 'P'.");
            //     return false;
            // }

        // Cek huruf bulan (karakter ke-2 harus huruf A–L)
            const bulanChar = value.charAt(1);
            const validBulan = /^[A-L]$/;
            if (!validBulan.test(bulanChar)) {
                showError(input, "Karakter ke-2 harus huruf bulan (A–L).");
                return false;
            }

        // Cek 2 digit tahun (karakter ke-3 & ke-4)
            // const yearNow = new Date().getFullYear().toString().slice(-2);
            // const yearPart = value.substr(2, 2);
            // if (yearPart !== yearNow) {
            //     showError(input, `Tahun tidak sesuai (${yearNow}).`);
            //     return false;
            // }

        // Cek shift (karakter ke-8–9)
            // const shiftCode = value.substr(7, 2);
            // const validShift = ["AA", "BB", "C", "CA", "CB", "CC"];
            // if (!validShift.some(code => shiftCode.startsWith(code.charAt(0)))) {
            //     showError(input, "Kode shift tidak valid (gunakan A, B, C, CA, BB, dst).");
            //     return false;
            // }

        // Cek karakter terakhir rework (0 atau 1)
            const rework = value.charAt(9);
            if (!["0", "1"].includes(rework)) {
                showError(input, "Karakter terakhir harus 0 (belum rework) atau 1 (rework).");
                return false;
            }

            return true;
        }

    // Fungsi menampilkan error di bawah input
        function showError(input, message) {
            input.addClass("is-invalid");
            input.after(`<div class="invalid-feedback">${message}</div>`);
        }

    // Jalankan validasi saat input berubah
        $(document).on("input blur", 'input[name$="[kode_batch]"]', function () {
            validateKodeBatch($(this));
        });

    // =================== VALIDASI FILE ===================
        function validateFile(input) {
            input.next(".invalid-feedback").remove();
            input.removeClass("is-invalid");

            if (!input[0].files || input[0].files.length === 0) {
                input.addClass("is-invalid");
                input.after(`<div class="invalid-feedback">Gambar wajib diunggah!</div>`);
                return false;
            }
            return true;
        }

    // =================== TAMBAH BARIS ===================
        let index = 0;
        const mesinOptions = `{!! collect($mesins)->map(fn($m) => "<option value='{$m->nama_mesin}'>{$m->nama_mesin}</option>")->implode('') !!}`;

        $('#addRow').on('click', function () {
            index++;
            $('#pvdcBody').append(`
        <tr>
            <td>
                <select name="data_pvdc[${index}][mesin]" class="form-control form-control-sm" required>
                    <option value="">-- Pilih Mesin --</option>${mesinOptions}
                </select>
            </td>
            <td>
                <input type="text" name="data_pvdc[${index}][kode_batch]" class="form-control form-control-sm" required>
            </td>
            <td>
                <input type="file" name="data_pvdc[${index}][kode_produksi]" class="form-control form-control-sm" accept="image/*" required>
            </td>
            <td>
                <input type="text" name="data_pvdc[${index}][keterangan]" class="form-control form-control-sm">
                <div class="preview mt-2"></div>
            </td>
            <td>
                <button type="button" class="btn btn-primary btn-sm saveRow">Simpan</button>
                <button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button>
            </td>
        </tr>
            `);
        });

    // =================== HAPUS BARIS ===================
        $('#pvdcBody').on('click', '.saveRow', function () {
            const row = $(this).closest('tr');
            const btn = $(this);
            const mesin = row.find('select[name^="data_pvdc"]').val();
            const kodeBatch = row.find('input[name$="[kode_batch]"]').val();
            const fileInput = row.find('input[type="file"]')[0];
            const file = fileInput ? fileInput.files[0] : null;
            const ket = row.find('input[name$="[keterangan]"]').val();

    // Validasi local
            row.find('.invalid-feedback').remove();
            if (!mesin || !kodeBatch || !file) {
                if(!mesin) row.find('select[name^="data_pvdc"]').after('<div class="invalid-feedback d-block">Mesin harus dipilih</div>');
                if(!kodeBatch) row.find('input[name$="[kode_batch]"]').after('<div class="invalid-feedback d-block">Kode batch harus diisi</div>');
                if(!file) row.find('input[type="file"]').after('<div class="invalid-feedback d-block">File harus diupload</div>');
                return;
            }

            const formData = new FormData();
            formData.append('mesin', mesin);
    formData.append('kode_batch', kodeBatch); // ❌ Pastikan ini key sama dengan validasi di controller
    formData.append('file', file);
    formData.append('keterangan', ket || '');
    formData.append('_token', '{{ csrf_token() }}');

    btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Menyimpan...');

    $.ajax({
        url: "{{ route('labelisasi_pvdc.saveRowTemp') }}",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            if(res.success){
                const preview = `
                <a href="${res.file}" target="_blank" class="d-block mt-2">
                    <img src="${res.file}" width="100" class="img-thumbnail"><br>
                </a>`;
                row.find('.preview').html(preview);
                btn.removeClass('btn-primary').addClass('btn-success')
                .html('<i class="bi bi-check-circle"></i> Tersimpan');
            } else {
                row.find('input[type="file"]').after('<div class="invalid-feedback d-block">'+res.message+'</div>');
                btn.prop('disabled', false).html('Simpan');
            }
        },
        error: function(err){
            let errors = err.responseJSON?.errors || {};
            if(errors.kode_batch){
                row.find('input[name$="[kode_batch]"]').after('<div class="invalid-feedback d-block">'+errors.kode_batch[0]+'</div>');
            }
            if(errors.file){
                row.find('input[type="file"]').after('<div class="invalid-feedback d-block">'+errors.file[0]+'</div>');
            }
            btn.prop('disabled', false).html('Simpan');
        }
    });
});


    // =================== SIMPAN FINAL ===================
        $('#saveBtn').click(function () {
            const btn = $(this);
            const rows = $('#pvdcBody tr');
            let isValid = true;

            rows.each(function () {
                const kodeBatchInput = $(this).find('input[name$="[kode_batch]"]');
                const fileInput = $(this).find('input[type="file"]');
                const mesinSelect = $(this).find('select[name^="data_pvdc"]');

    // VALIDASI HANYA MESIN, KODE BATCH, FILE
                if (!validateKodeBatch(kodeBatchInput)) isValid = false;
                if (!validateFile(fileInput)) isValid = false;
                if (!mesinSelect.val()) {
                    mesinSelect.addClass("is-invalid")
                    .next(".invalid-feedback").remove();
                    mesinSelect.after(`<div class="invalid-feedback">Mesin wajib dipilih!</div>`);
                    isValid = false;
                }

    // Jangan cek keterangan sama sekali
                if (!isValid) $(this).addClass('table-danger');
                else $(this).removeClass('table-danger');
            });


        if (!isValid) return; // Jangan lanjut jika ada error

        // AJAX simpan final
        btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Menyimpan...');
        const formData = new FormData($('#pvdcForm')[0]);

        $.ajax({
            url: "{{ route('labelisasi_pvdc.storeFinal') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) window.location.href = res.redirect_url;
                else $('#resultArea').html(`<div class="alert alert-danger">${res.message}</div>`);
            },
            error: function () {
                $('#resultArea').html(`<div class="alert alert-danger">Terjadi kesalahan saat menyimpan data.</div>`);
            },
            complete: function () {
                btn.prop('disabled', false).html('<i class="bi bi-save"></i> Simpan');
            }
        });
    });
    });
</script>

@endsection
