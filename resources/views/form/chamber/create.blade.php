@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-4">
                <i class="bi bi-plus-circle"></i> Form Input Verifikasi Timer Chamber
            </h4>

            <form id="pvdcForm" action="{{ route('chamber.store') }}" method="POST">
                @csrf

                {{-- ===================== IDENTITAS ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Identitas Data Chamber</strong>
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
                    </div>
                </div>

                {{-- ===================== DATA CHAMBER ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                        <strong>Data Chamber</strong>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-light">
                                <tr class="table-info">
                                    <th rowspan="2" colspan="2" class="align-middle">RENTANG UKUR</th>
                                    @foreach($list_chambers as $index => $list_chamber)
                                    <th colspan="6">No. Chamber {{ $list_chamber->nama_mesin }}</th>
                                    @endforeach
                                </tr>
                                <tr class="table-secondary">
                                    @foreach($list_chambers as $index => $list_chamber)
                                    <th colspan="2">PLC</th>
                                    <th colspan="2">STOPWATCH</th>
                                    <th colspan="2">FAKTOR KOREKSI</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>MENIT</th>
                                    <th>DETIK</th>
                                    @foreach($list_chambers as $index => $list_chamber)
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
                                    <td>
                                        <input type="number" name="verifikasi[{{ $index }}][plc_menit_{{ $rentang }}]"
                                        class="form-control form-control-sm"
                                        style="min-width: 80px;"
                                        value="{{ old('verifikasi.'.$index.'.plc_menit_'.$rentang) }}">
                                    </td>
                                    <td>
                                        <input type="number" name="verifikasi[{{ $index }}][plc_detik_{{ $rentang }}]"
                                        class="form-control form-control-sm"
                                        style="min-width: 80px;"
                                        value="{{ old('verifikasi.'.$index.'.plc_detik_'.$rentang) }}">
                                    </td>
                                    <td>
                                        <input type="number" name="verifikasi[{{ $index }}][stopwatch_menit_{{ $rentang }}]"
                                        class="form-control form-control-sm"
                                        style="min-width: 80px;"
                                        value="{{ old('verifikasi.'.$index.'.stopwatch_menit_'.$rentang) }}">
                                    </td>
                                    <td>
                                        <input type="number" name="verifikasi[{{ $index }}][stopwatch_detik_{{ $rentang }}]"
                                        class="form-control form-control-sm"
                                        style="min-width: 80px;"
                                        value="{{ old('verifikasi.'.$index.'.stopwatch_detik_'.$rentang) }}">
                                    </td>
                                    <td colspan="2">
                                        <input type="text" name="verifikasi[{{ $index }}][faktor_koreksi_{{ $rentang }}]"
                                        class="form-control form-control-sm"
                                        style="min-width: 100px;"
                                        value="{{ old('verifikasi.'.$index.'.faktor_koreksi_'.$rentang) }}">
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-warning text-white">
                        <strong>Operator</strong>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
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

                {{-- ===================== Catatan ===================== --}}
                <div class="card mb-4">
                    <div class="card-header bg-light"><strong>Catatan</strong></div>
                    <div class="card-body">
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan bila ada">{{ old('catatan', $data->catatan ?? '') }}</textarea>
                    </div>
                </div>

                {{-- ===================== TOMBOL ===================== --}}
                <div class="d-flex justify-content-between mt-3">
                 <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="{{ route('chamber.index') }}" class="btn btn-secondary">
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
@endsection
