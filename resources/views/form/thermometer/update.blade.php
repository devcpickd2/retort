@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-pencil-square"></i> Edit Data Peneraan Thermometer
            </h4>

            <form method="POST" action="{{ route('thermometer.update_qc', $thermometer->uuid) }}" enctype="multipart/form-data">
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
                                <input type="date" name="date"
                                class="form-control"
                                value="{{ $thermometer->date }}"
                                {{ $thermometer->date ? 'readonly' : '' }} required>
                            </div>

                            {{-- Shift --}}
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select name="shift" class="form-control selectpicker"
                                {{ $thermometer->shift ? 'disabled' : '' }} required>
                                <option value="1" {{ $thermometer->shift == 1 ? 'selected' : '' }}>Shift 1</option>
                                <option value="2" {{ $thermometer->shift == 2 ? 'selected' : '' }}>Shift 2</option>
                                <option value="3" {{ $thermometer->shift == 3 ? 'selected' : '' }}>Shift 3</option>
                            </select>

                            {{-- hidden field agar tetap terkirim --}}
                            @if($thermometer->shift)
                            <input type="hidden" name="shift" value="{{ $thermometer->shift }}">
                            @endif
                        </div>

                    </div>

                </div>
            </div>

            {{-- ===================== PEMERIKSAAN ===================== --}}
            <div class="card mb-3">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <strong>Peneraan Thermometer</strong>
                    <button type="button" id="addRow" class="btn btn-light btn-sm text-dark">
                        <i class="bi bi-plus-lg"></i> Tambah Peneraan
                    </button>
                </div>

                <div class="card-body p-0">

                    <div class="alert alert-warning mt-2 py-3 px-3" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle"></i>
                        <strong>Keterangan:</strong>
                        <ul class="mb-2 mt-2">
                            <li>Tera thermometer dilakukan di setiap awal shift</li>
                            <li>Thermometer harus menunjukkan ±0°C ketika ditera dalam es</li>
                            <li>Jika terdapat selisih >0.5°C → harus dikalibrasi / perbaikan</li>
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center align-middle" id="pemeriksaanTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Thermometer</th>
                                    <th>Area</th>
                                    <th>Standar (°C)</th>
                                    <th>Pukul</th>
                                    <th>Hasil Tera</th>
                                    <th>Tindakan Perbaikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="peneraanTable">
                                @foreach($thermometer->peneraan as $i => $p)

                                @php
                                // untuk tombol delete: aktif hanya jika SEMUA kolom kosong
                                $allEmpty = 
                                empty($p['kode_thermometer']) &&
                                empty($p['area']) &&
                                ($p['standar'] === null || $p['standar'] === '') &&
                                empty($p['pukul']) &&
                                ($p['hasil_tera'] === null || $p['hasil_tera'] === '') &&
                                empty($p['tindakan_perbaikan']);
                                @endphp

                                <tr>
                                    <td>
                                        <input type="text"
                                        class="form-control form-control-sm"
                                        name="peneraan[{{ $i }}][kode_thermometer]"
                                        value="{{ $p['kode_thermometer'] }}"
                                        {{ !empty($p['kode_thermometer']) ? 'readonly' : '' }}>
                                    </td>

                                    <td>
                                        <input type="text"
                                        class="form-control form-control-sm"
                                        name="peneraan[{{ $i }}][area]"
                                        value="{{ $p['area'] }}"
                                        {{ !empty($p['area']) ? 'readonly' : '' }}>
                                    </td>

                                    <td>
                                        <input type="number" step="0.1"
                                        class="form-control form-control-sm"
                                        name="peneraan[{{ $i }}][standar]"
                                        value="{{ $p['standar'] }}"
                                        {{ ($p['standar'] !== null && $p['standar'] !== '') ? 'readonly' : '' }}>
                                    </td>

                                    <td>
                                        <input type="time"
                                        class="form-control form-control-sm"
                                        name="peneraan[{{ $i }}][pukul]"
                                        value="{{ $p['pukul'] }}"
                                        {{ !empty($p['pukul']) ? 'readonly' : '' }}>
                                    </td>

                                    <td>
                                        <input type="number" step="0.1"
                                        class="form-control form-control-sm"
                                        name="peneraan[{{ $i }}][hasil_tera]"
                                        value="{{ $p['hasil_tera'] }}"
                                        {{ ($p['hasil_tera'] !== null && $p['hasil_tera'] !== '') ? 'readonly' : '' }}>
                                    </td>

                                    <td>
                                        <input type="text"
                                        class="form-control form-control-sm"
                                        name="peneraan[{{ $i }}][tindakan_perbaikan]"
                                        value="{{ $p['tindakan_perbaikan'] }}"
                                        {{ !empty($p['tindakan_perbaikan']) ? 'readonly' : '' }}>
                                    </td>

                                    <td>
                                        @if($allEmpty)
                                        <button type="button" class="btn btn-danger btn-sm removeRow">
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

            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-primary w-auto"><i class="bi bi-save"></i> Update</button>
                <a href="{{ route('thermometer.index') }}" class="btn btn-secondary w-auto"><i class="bi bi-arrow-left"></i> Batal</a>
            </div>

        </form>
    </div>
</div>
</div>

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
        $('#addRow').click(function () {
            const table = $('#peneraanTable');
            const index = table.find('tr').length;
            const clone = table.find('tr:last').clone();

            clone.find('input').each(function () {
                const name = $(this).attr('name');
                const key = name.match(/\[([a-zA-Z0-9_]+)\]$/);

                $(this).val('').removeAttr('readonly');

                if (key) {
                    $(this).attr('name', `peneraan[${index}][${key[1]}]`);
                }
            });

            clone.find('td:last').html(`
            <button type="button" class="btn btn-danger btn-sm removeRow">
                <i class="bi bi-trash"></i>
            </button>
            `);

            table.append(clone);
        });

    // Hapus baris baru
        $(document).on('click', '.removeRow', function () {
            $(this).closest('tr').remove();
        });
    });
</script>

<style>
    .table th, .table td { padding: 0.5rem; vertical-align: middle; font-size: 0.9rem; }
    .form-control-sm { min-width: 100px; font-size: 0.9rem; }
</style>

@endsection
