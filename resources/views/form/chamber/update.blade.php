@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-pencil-square"></i> Edit Verifikasi Timer Chamber
            </h4>

            <form id="editChamberForm" action="{{ route('chamber.update_qc', $chamber->uuid) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ===================== IDENTITAS ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Data Chamber</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="date" class="form-control" 
                                       value="{{ old('date', $chamber->date) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label>
                                <select name="shift" class="form-control" required>
                                    <option value="">-- Pilih Shift --</option>
                                    <option value="1" {{ old('shift', $chamber->shift) == '1' ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ old('shift', $chamber->shift) == '2' ? 'selected' : '' }}>Shift 2</option>
                                    <option value="3" {{ old('shift', $chamber->shift) == '3' ? 'selected' : '' }}>Shift 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===================== DATA CHAMBER ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white">
                        <strong>Data Chamber</strong>
                    </div>

                    <div class="card-body table-responsive">

                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-light">
                                <tr class="table-info">
                                    <th rowspan="2" colspan="2" class="align-middle">RENTANG UKUR</th>
                                    @foreach($list_chambers as $list_chamber)
                                        <th colspan="6">No. Chamber {{ $list_chamber->nama_mesin }}</th>
                                    @endforeach
                                </tr>
                                <tr class="table-secondary">
                                    @foreach($list_chambers as $list_chamber)
                                        <th colspan="2">PLC</th>
                                        <th colspan="2">STOPWATCH</th>
                                        <th colspan="2">FAKTOR KOREKSI</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>MENIT</th>
                                    <th>DETIK</th>
                                    @foreach($list_chambers as $list_chamber)
                                        <th>MENIT</th>
                                        <th>DETIK</th>
                                        <th>MENIT</th>
                                        <th>DETIK</th>
                                        <th colspan="2"></th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>

                                @php
                                    $rentang_menit = [5, 10, 20, 30, 60];
                                    $rentang_detik = [0, 0, 0, 0, 0];
                                @endphp

                                @foreach($rentang_menit as $key => $rentang)
                                    <tr>
                                        <td>{{ $rentang }}</td>
                                        <td>{{ str_pad($rentang_detik[$key], 2, '0', STR_PAD_LEFT) }}</td>

                                        @foreach($list_chambers as $index => $list_chamber)

                                            @php
                                                $data = $chamberData[$index] ?? [];

                                                $plc_m = $data["plc_menit_$rentang"] ?? '';
                                                $plc_d = $data["plc_detik_$rentang"] ?? '';
                                                $sw_m  = $data["stopwatch_menit_$rentang"] ?? '';
                                                $sw_d  = $data["stopwatch_detik_$rentang"] ?? '';
                                                $fk    = $data["faktor_koreksi_$rentang"] ?? '';

                                                $lock = fn($v) => ($v !== null && $v !== '');
                                            @endphp

                                            {{-- PLC MENIT --}}
                                            <td>
                                                <input type="number"
                                                       class="form-control form-control-sm"
                                                       name="verifikasi[{{ $index }}][plc_menit_{{ $rentang }}]"
                                                       value="{{ $plc_m }}"
                                                       {{ $lock($plc_m) ? 'readonly' : '' }}>
                                            </td>

                                            {{-- PLC DETIK --}}
                                            <td>
                                                <input type="number"
                                                       class="form-control form-control-sm"
                                                       name="verifikasi[{{ $index }}][plc_detik_{{ $rentang }}]"
                                                       value="{{ $plc_d }}"
                                                       {{ $lock($plc_d) ? 'readonly' : '' }}>
                                            </td>

                                            {{-- STOPWATCH MENIT --}}
                                            <td>
                                                <input type="number"
                                                       class="form-control form-control-sm"
                                                       name="verifikasi[{{ $index }}][stopwatch_menit_{{ $rentang }}]"
                                                       value="{{ $sw_m }}"
                                                       {{ $lock($sw_m) ? 'readonly' : '' }}>
                                            </td>

                                            {{-- STOPWATCH DETIK --}}
                                            <td>
                                                <input type="number"
                                                       class="form-control form-control-sm"
                                                       name="verifikasi[{{ $index }}][stopwatch_detik_{{ $rentang }}]"
                                                       value="{{ $sw_d }}"
                                                       {{ $lock($sw_d) ? 'readonly' : '' }}>
                                            </td>

                                            {{-- FAKTOR KOREKSI --}}
                                            <td colspan="2">
                                                <input type="text"
                                                       class="form-control form-control-sm"
                                                       name="verifikasi[{{ $index }}][faktor_koreksi_{{ $rentang }}]"
                                                       value="{{ $fk }}"
                                                       {{ $lock($fk) ? 'readonly' : '' }}>
                                            </td>

                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                {{-- ===================== OPERATOR ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white"><strong>Operator</strong></div>
                    <div class="card-body">
                        <label class="form-label">Nama Operator</label>
                        <select id="nama_operator" name="nama_operator" class="form-control selectpicker" data-live-search="true" required>
                            <option value="">-- Pilih Operator --</option>
                            @foreach($operators as $operator)
                                <option value="{{ $operator->nama_karyawan }}"
                                    {{ old('nama_operator', $chamber->nama_operator) == $operator->nama_karyawan ? 'selected' : '' }}>
                                    {{ $operator->nama_karyawan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- ===================== CATATAN ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-light"><strong>Catatan</strong></div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $chamber->catatan) }}</textarea>
                    </div>
                </div>

                {{-- ===================== TOMBOL ===================== --}}
                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('chamber.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Selectpicker --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(){
        $('.selectpicker').selectpicker();
    });
</script>
@endsection
