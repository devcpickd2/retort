@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-pencil-square"></i> Edit Data Peneraan Timbangan
            </h4>
            <form method="POST" action="{{ route('timbangan.update_qc', $timbangan->uuid) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ===================== IDENTITAS ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">

                            {{-- Tanggal (lock bila sudah ada) --}}
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" id="dateInput" name="date"
                                class="form-control"
                                value="{{ old('date', $timbangan->date) }}"
                                {{ $timbangan->date ? 'readonly' : '' }}
                                required>
                            </div>

                            {{-- Shift (lock bila sudah ada) --}}
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select id="shiftInput" name="shift"
                                class="form-control selectpicker"
                                {{ $timbangan->shift ? 'disabled' : '' }} required>

                                <option value="1" {{ old('shift', $timbangan->shift) == '1' ? 'selected' : '' }}>Shift 1</option>
                                <option value="2" {{ old('shift', $timbangan->shift) == '2' ? 'selected' : '' }}>Shift 2</option>
                                <option value="3" {{ old('shift', $timbangan->shift) == '3' ? 'selected' : '' }}>Shift 3</option>
                            </select>

                            {{-- Hidden input agar disabled tetap terkirim --}}
                            @if($timbangan->shift)
                            <input type="hidden" name="shift" value="{{ $timbangan->shift }}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===================== PEMERIKSAAN ===================== --}}
            <div class="card mb-3">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <strong>Peneraan Timbangan</strong>

                    {{-- Tombol hanya aktif bila data belum dikunci --}}
                    <button type="button" id="addRow"
                    class="btn btn-light btn-sm text-dark"
                    {{ count($peneraan) > 0 ? '' : '' }}>
                    <i class="bi bi-plus-lg"></i> Tambah Peneraan
                </button>
            </div>

            <div class="card-body p-0">
                <div class="alert alert-warning mt-2 py-3 px-3" style="font-size: 0.9rem;">
                    <i class="bi bi-info-circle"></i>
                    <strong>Keterangan:</strong>
                    <ul class="mb-2 mt-2">
                        <li>Tera Timbangan dilakukan di setiap awal produksi</li>
                        <li>Timbangan ditera menggunakan anak timbangan standar</li>
                        <li>Jika ada selisih angka timbang dengan berat standar, beri keterangan (+) atau (-)</li>
                    </ul>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center align-middle" id="pemeriksaanTable">
                        <thead class="table-light">
                            <tr>
                                <th rowspan="2">Kode Timbangan</th>
                                <th rowspan="2">Standar (gr)</th>
                                <th colspan="2">Peneraan</th>
                                <th rowspan="2">Tindakan Perbaikan</th>
                                <th rowspan="2">Aksi</th>
                            </tr>
                            <tr>
                                <th>Pukul</th>
                                <th>Hasil Tera</th>
                            </tr>
                        </thead>

                        <tbody id="peneraanTable">
                            @foreach($peneraan as $index => $p)
                            <tr>
                                <td>
                                    <input type="text"
                                    name="peneraan[{{ $index }}][kode_timbangan]"
                                    class="form-control form-control-sm"
                                    value="{{ $p->kode_timbangan }}"
                                    {{ $p->kode_timbangan ? 'readonly' : '' }}>
                                </td>

                                <td>
                                    <input type="number"
                                    name="peneraan[{{ $index }}][standar]"
                                    class="form-control form-control-sm"
                                    value="{{ $p->standar }}"
                                    {{ $p->standar ? 'readonly' : '' }}>
                                </td>

                                <td>
                                    <input type="time"
                                    name="peneraan[{{ $index }}][pukul]"
                                    class="form-control form-control-sm"
                                    value="{{ $p->pukul }}"
                                    {{ $p->pukul ? 'readonly' : '' }}>
                                </td>

                                <td>
                                    <input type="number"
                                    name="peneraan[{{ $index }}][hasil_tera]"
                                    class="form-control form-control-sm"
                                    value="{{ $p->hasil_tera }}"
                                    step="0.1"
                                    {{ $p->hasil_tera ? 'readonly' : '' }}>
                                </td>

                                <td>
                                    <input type="text"
                                    name="peneraan[{{ $index }}][tindakan_perbaikan]"
                                    class="form-control form-control-sm"
                                    value="{{ $p->tindakan_perbaikan }}"
                                    {{ $p->tindakan_perbaikan ? 'readonly' : '' }}>
                                </td>

                                <td>
                                    {{-- tombol delete: aktif hanya kalau datanya kosong --}}
                                    @if(!$p->kode_timbangan && !$p->standar && !$p->pukul && !$p->hasil_tera && !$p->tindakan_perbaikan)
                                    <button type="button" class="btn btn-danger btn-sm deleteRow">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-secondary btn-sm" disabled>
                                        <i class="bi bi-lock"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

        {{-- ===================== TOMBOL UPDATE ===================== --}}
        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-primary w-auto">
                <i class="bi bi-save"></i> Update Data
            </button>
            <a href="{{ route('timbangan.index') }}" class="btn btn-secondary w-auto">
                <i class="bi bi-arrow-left"></i> Batal
            </a>
        </div>
    </form>
</div>
</div>
</div>

{{-- ===================== SCRIPTS ===================== --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>

<script>
    $(document).ready(function () {

        // Tambah baris hanya untuk input baru (baris lama readonly)
        $(document).on('click', '#addRow', function () {
            const table = $('#pemeriksaanTable tbody');
            const index = table.find('tr').length;
            const clone = table.find('tr:last').clone();

            clone.find('input').each(function () {
                const name = $(this).attr('name');

                // reset nilai & hapus readonly
                $(this).val('').removeAttr('readonly');

                if (name) {
                    const key = name.match(/\[([a-zA-Z0-9_]+)\]$/);
                    if (key && key[1]) {
                        $(this).attr('name', `peneraan[${index}][${key[1]}]`);
                    }
                }
            });

            clone.find('.btn').removeAttr('disabled').addClass('removeRow btn-danger').html('<i class="bi bi-trash"></i>');

            table.append(clone);
        });

        // Hapus baris (hanya untuk baris baru)
        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });
    });
</script>

<style>
    .table th, .table td {
        padding: 0.5rem;
        vertical-align: middle;
        font-size: 0.9rem;
    }
    .form-control-sm {
        min-width: 90px;
        font-size: 0.9rem;
    }
    .b {
        min-width: 150px;
        font-size: 0.9rem;
    }
    .a {
        min-width: 250px;
        font-size: 0.9rem;
    }
    .table-bordered th, .table-bordered td {
        text-align: center;
    }
</style>
@endsection
