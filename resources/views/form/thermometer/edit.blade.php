@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-pencil-square"></i> Edit Data Peneraan Thermometer
            </h4>

            <form method="POST" action="{{ route('thermometer.edit_spv', $thermometer->uuid) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ===================== IDENTITAS ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Pemeriksaan</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control"
                                value="{{ old('date', $thermometer->date) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select name="shift" class="form-control selectpicker" required>
                                    <option value="1" {{ old('shift', $thermometer->shift) == '1' ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ old('shift', $thermometer->shift) == '2' ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ old('shift', $thermometer->shift) == '3' ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===================== PEMERIKSAAN ===================== --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <strong>Edit Peneraan Thermometer</strong>
                        <button type="button" id="addRow" class="btn btn-light btn-sm text-dark">
                            <i class="bi bi-plus-lg"></i> Tambah Peneraan
                        </button>
                    </div>

                    <div class="card-body p-0">
                        <div class="alert alert-warning mt-2 py-3 px-3" style="font-size: 0.9rem;">
                            <i class="bi bi-info-circle"></i>
                            <strong>Keterangan:</strong>
                            <ul class="mb-2 mt-2">
                                <li>Tera Thermometer dilakukan di setiap awal shift</li>
                                <li>Thermometer ditera dengan memasukkan sensor (probe) di es (0°C)</li>
                                <li>Jika ada selisih angka display suhu dengan suhu standar es, beri keterangan (+) atau (-) angka selisih (faktor koreksi)</li>
                                <li>Jika faktor koreksi <0.5°C, thermometer perlu perbaikan</li>
                                </ul>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-center align-middle" id="pemeriksaanTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th rowspan="2">Kode Thermometer</th>
                                            <th rowspan="2">Area</th>
                                            <th rowspan="2">Standar (0.0°C)</th>
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
                                      @foreach($thermometer->peneraan as $i => $row)
                                      <tr>
                                        <td><input type="text" name="peneraan[{{ $i }}][kode_thermometer]" class="form-control form-control-sm a peneraan" value="{{ $row['kode_thermometer'] }}" required></td>
                                        <td><input type="text" name="peneraan[{{ $i }}][area]" class="form-control form-control-sm a peneraan" value="{{ $row['area'] }}" required></td>
                                        <td><input type="number" name="peneraan[{{ $i }}][standar]" class="form-control form-control-sm peneraan" value="{{ $row['standar'] }}" step="0.1" required></td>
                                        <td><input type="time" name="peneraan[{{ $i }}][pukul]" class="form-control form-control-sm peneraan" value="{{ $row['pukul'] }}" required></td>
                                        <td><input type="number" name="peneraan[{{ $i }}][hasil_tera]" class="form-control form-control-sm peneraan" value="{{ $row['hasil_tera'] }}" step="0.1" required></td>
                                        <td><input type="text" name="peneraan[{{ $i }}][tindakan_perbaikan]" class="form-control form-control-sm b release" value="{{ $row['tindakan_perbaikan'] }}"></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm removeRow">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- ===================== TOMBOL SIMPAN ===================== --}}
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary w-auto">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('thermometer.verification') }}" class="btn btn-secondary w-auto">
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

        // Tambah baris baru
        $(document).on('click', '#addRow', function () {
            const table = $('#pemeriksaanTable tbody');
            const index = table.find('tr').length;
            const clone = table.find('tr:first').clone();

            clone.find('input').each(function () {
                const name = $(this).attr('name');
                if (name) {
                    const key = name.match(/\[([a-zA-Z0-9_]+)\]$/);
                    if (key && key[1]) {
                        $(this).attr('name', `peneraan[${index}][${key[1]}]`);
                    }
                }
                $(this).val('').removeClass('is-valid is-invalid');
            });

            table.append(clone);
        });

        // Hapus baris
        $(document).on('click', '.removeRow', function () {
            if ($('#pemeriksaanTable tbody tr').length > 1) {
                $(this).closest('tr').remove();
            } else {
                alert('Minimal harus ada satu baris pemeriksaan.');
            }
        });
    });
</script>

<style>
    .table th,
    .table td {
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
    .table-bordered th,
    .table-bordered td {
        text-align: center;
    }
</style>
@endsection
